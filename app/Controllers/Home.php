<?php

namespace App\Controllers;

use App\Models\PembayaranModel;
use App\Models\UserModel;
use App\Models\ProdukModel;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;

class Home extends BaseController
{
    protected $userModel;
    protected $produkModel;
    protected $pembayaranModel;
    protected $transaksiModel;
    protected $transaksiDetailModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->produkModel = new ProdukModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->transaksiModel = new TransaksiModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
    }

    public function index(): string
    {
        $auth = service('authentication');
        if (!$auth->isLoggedIn()) return redirect()->to('/login');

        $title = 'Dashboard';
        $user = $this->userModel->find($auth->id());
        $produk = $this->produkModel->getProduk();
        $pembayaran = $this->pembayaranModel->findAll();
        $topOrderedProducts = $this->produkModel->getTopOrderedProducts();
        $stokProduk = array_column($produk, 'stok');
        $namaProduk = array_column($produk, 'nama');
        $currentYear = date('Y');
        $pendapatanBulanan = $this->transaksiDetailModel->getPendapatanBulanan($currentYear);
        $metodePembayaran = $this->transaksiModel->getMetodePembayaranCount();
        $pendapatanBulanIni = $this->transaksiDetailModel->getPendapatanByMonth($currentYear, date('m'));
        $pendapatanBulanLalu = $this->transaksiDetailModel->getPendapatanByMonth($currentYear, date('m', strtotime('-1 month')));
        $statusPerbandingan = $this->bandingkanPendapatan($pendapatanBulanIni, $pendapatanBulanLalu);
        $perbandinganPembayaran = $this->bandingkanPembayaran(
            $this->pembayaranModel->getMetodePembayaranCountByMonth($currentYear, date('m')),
            $this->pembayaranModel->getMetodePembayaranCountByMonth($currentYear, date('m', strtotime('-1 month')))
        );
        $bgClass = $this->tentukanKelasCSS($pendapatanBulanIni, $pendapatanBulanLalu);
        $totalPendapatan = $this->transaksiDetailModel->getTotalPendapatan();

        return view('pages/index', compact(
            'title',
            'user',
            'produk',
            'stokProduk',
            'namaProduk',
            'pendapatanBulanan',
            'pembayaran',
            'metodePembayaran',
            'statusPerbandingan',
            'totalPendapatan',
            'perbandinganPembayaran',
            'topOrderedProducts',
            'bgClass'
        ));
    }

    private function bandingkanPendapatan($pendapatanBulanIni, $pendapatanBulanLalu)
    {
        if ($pendapatanBulanLalu == 0) return 'Tidak ada data pendapatan bulan lalu untuk perbandingan';
        $selisih = $pendapatanBulanIni - $pendapatanBulanLalu;
        $persentase = ($selisih / $pendapatanBulanLalu) * 100;
        return $selisih > 0
            ? "Pendapatan bulan ini meningkat sebesar " . number_format($persentase, 2) . "% dibandingkan dengan bulan lalu"
            : ($selisih < 0
                ? "Pendapatan bulan ini menurun sebesar " . number_format(abs($persentase), 2) . "% dibandingkan dengan bulan lalu"
                : 'Pendapatan bulan ini sama dengan bulan lalu.');
    }

    private function bandingkanPembayaran($bulanIni, $bulanLalu)
    {
        $hasilPerbandingan = [];
        foreach ($bulanIni as $pembayaranIni) {
            $idPembayaran = $pembayaranIni['id_pembayaran'];
            $countBulanIni = $pembayaranIni['count'];
            $namaPembayaran = $this->pembayaranModel->getNamaPembayaranById($idPembayaran)['nama'];
            $countBulanLalu = 0;
            foreach ($bulanLalu as $pembayaranLalu) {
                if ($pembayaranLalu['id_pembayaran'] == $idPembayaran) {
                    $countBulanLalu = $pembayaranLalu['count'];
                    break;
                }
            }
            $persentase = $countBulanLalu == 0 ? ($countBulanIni > 0 ? 100 : 0) : (($countBulanIni - $countBulanLalu) / $countBulanLalu) * 100;
            $status = $persentase > 0 ? 'meningkat' : ($persentase < 0 ? 'menurun' : 'sama');
            $hasilPerbandingan[] = compact('namaPembayaran', 'countBulanIni', 'countBulanLalu', 'persentase', 'status');
        }
        return $hasilPerbandingan;
    }

    private function tentukanKelasCSS($pendapatanBulanIni, $pendapatanBulanLalu)
    {
        if ($pendapatanBulanLalu == 0) return 'bg-secondary';
        return $pendapatanBulanIni > $pendapatanBulanLalu ? 'bg-success' : ($pendapatanBulanIni < $pendapatanBulanLalu ? 'bg-danger' : 'bg-secondary');
    }

    public function simpanTagihan()
    {
        $produkId = $this->request->getVar('produk');
        $jumlah = $this->request->getVar('jumlah');
        $pembayaran = $this->request->getVar('pembayaran');
        $insufficientStock = $this->cekStok($produkId, $jumlah);
        if ($insufficientStock) {
            return redirect()->to('/')->with('error', 'Stok produk berikut tidak mencukupi: ' . implode(', ', $insufficientStock) . '.');
        }
        $this->transaksiModel->save(['id_cashier' => user()->id, 'id_pembayaran' => $pembayaran]);
        $transaksiId = $this->transaksiModel->insertID();
        $this->simpanDetailTransaksi($transaksiId, $produkId, $jumlah);
        return redirect()->to('/')->with('success', 'Tagihan berhasil disimpan dan stok produk telah diperbarui.');
    }

    private function cekStok(array $produkId, array $jumlah): array
    {
        $insufficientStock = [];
        foreach ($produkId as $index => $id) {
            $produk = $this->produkModel->find($id);
            if ($produk['stok'] < $jumlah[$index]) $insufficientStock[] = $produk['nama'];
        }
        return $insufficientStock;
    }

    private function simpanDetailTransaksi(int $transaksiId, array $produkId, array $jumlah): void
    {
        foreach ($produkId as $index => $id) {
            $produk = $this->produkModel->find($id);
            $this->transaksiDetailModel->save([
                'id_transaksi' => $transaksiId,
                'id_produk' => $id,
                'jumlah' => $jumlah[$index],
                'harga' => $produk['harga'],
            ]);
            $this->produkModel->update($id, ['stok' => $produk['stok'] - $jumlah[$index]]);
        }
    }
}

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
        if (!$auth->isLoggedIn()) {
            return redirect()->to('/login');
        }

        $user = $this->userModel->find($auth->id());
        $produk = $this->produkModel->findAll();
        $pembayaran = $this->pembayaranModel->findAll();

        // Ambil data stok dan nama produk
        $stokProduk = array_column($produk, 'stok');
        $namaProduk = array_column($produk, 'nama');

        // Ambil data pendapatan per bulan di tahun ini
        $currentYear = date('Y');
        $pendapatanBulanan = $this->transaksiDetailModel->getPendapatanBulanan($currentYear);

        // dd($pembayaran);

        return view('pages/index', [
            'title' => 'Home',
            'user' => $user,
            'produk' => $produk,
            'stokProduk' => $stokProduk,
            'namaProduk' => $namaProduk,
            'pendapatanBulanan' => $pendapatanBulanan,
            'pembayaran' => $pembayaran,
        ]);
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

        // Simpan transaksi utama
        $transaksiData = [
            'id_cashier' => user()->id,
            'id_pembayaran' => $pembayaran,
        ];
        $this->transaksiModel->save($transaksiData);
        $transaksiId = $this->transaksiModel->insertID();

        // Simpan detail transaksi dan kurangi stok produk
        $this->simpanDetailTransaksi($transaksiId, $produkId, $jumlah);

        return redirect()->to('/')->with('success', 'Tagihan berhasil disimpan dan stok produk telah diperbarui.');
    }



    private function cekStok(array $produkId, array $jumlah): array
    {
        $insufficientStock = [];

        foreach ($produkId as $index => $id) {
            $produk = $this->produkModel->find($id);
            if ($produk['stok'] < $jumlah[$index]) {
                $insufficientStock[] = $produk['nama'];
            }
        }

        return $insufficientStock;
    }

    private function simpanDetailTransaksi(int $transaksiId, array $produkId, array $jumlah): void
    {
        foreach ($produkId as $index => $id) {
            $produk = $this->produkModel->find($id);

            $this->transaksiDetailModel->insert([
                'id_transaksi' => $transaksiId,
                'id_produk' => $id,
                'jumlah' => $jumlah[$index],
                'harga' => $this->request->getVar('total')[$index],
            ]);

            // Kurangi stok produk
            $this->produkModel->update($id, ['stok' => $produk['stok'] - $jumlah[$index]]);
        }
    }
}

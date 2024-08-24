<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Tagihan extends BaseController
{
    protected $tagihanModel;

    public function __construct()
    {
        $this->tagihanModel = new TransaksiModel();
    }

    public function tabletagihan()
    {
        $transaksi = $this->tagihanModel->getTransaksiWithCashier();

        $data = [
            'title' => 'Table Tagihan',
            'transaksi' => $transaksi
        ];

        return view('pages/tabletagihan', $data);
    }

    public function deletetagihan()
    {
        $id = $this->request->getPost('id');

        $this->tagihanModel->delete($id);

        return redirect()->to('/tabletagihan')->with('message', 'Tagihan berhasil dihapus.');
    }

    public function buktitagihan($id_transaksi)
    {
        $transaksiDetailModel = new \App\Models\TransaksiDetailModel();

        // Ambil data transaksi beserta nama produk berdasarkan ID transaksi
        $detailTransaksi = $transaksiDetailModel->getDetailTransaksiWithProduk($id_transaksi);

        // Ambil informasi umum transaksi beserta nama kasir
        $transaksi = $this->tagihanModel->getTransaksiWithCashier($id_transaksi);

        // Hitung subtotal
        $subtotal = 0;
        foreach ($detailTransaksi as $detail) {
            $subtotal += $detail['harga'] * $detail['jumlah'];
        }

        // Hitung pajak 5%
        $pajak = $subtotal * 0.05;

        // Hitung total amount
        $totalAmount = $subtotal + $pajak;

        $data = [
            'title' => 'Detail Tagihan',
            'transaksi' => $transaksi,
            'detailTransaksi' => $detailTransaksi,
            'subtotal' => $subtotal,
            'pajak' => $pajak,
            'totalAmount' => $totalAmount
        ];

        // dd($data);

        return view('pages/buktitagihan', $data);
    }
}

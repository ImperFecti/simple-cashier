<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProdukModel;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;

class Home extends BaseController
{
    protected $UserModel;
    protected $ProdukModel;
    protected $TransaksiModel;
    protected $TransaksiDetailModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->ProdukModel = new ProdukModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->TransaksiDetailModel = new TransaksiDetailModel();
    }

    public function index(): string
    {
        $auth = service('authentication');
        if (!$auth->isLoggedIn()) {
            return redirect()->to('/login');
        }

        $userId = $auth->id();
        $user = $this->UserModel->find($userId);
        $produk = $this->ProdukModel->getProduk();

        $data = [
            'title' => 'Home',
            'user' => $user,
            'produk' => $produk
        ];

        return view('pages/index', $data);
    }

    public function simpanTagihan()
    {
        $produkId = $this->request->getVar('produk');
        $jumlah = $this->request->getVar('jumlah');
        $pembayaran = $this->request->getVar('pembayaran');

        $insufficientStock = [];

        // Cek stok untuk setiap produk
        foreach ($produkId as $index => $id) {
            $produk = $this->ProdukModel->find($id);

            if ($produk['stok'] < $jumlah[$index]) {
                $insufficientStock[] = $produk['nama']; // Tambahkan nama produk yang stoknya tidak mencukupi
            }
        }

        // Jika ada produk yang stoknya tidak mencukupi, redirect dengan flash data dan hentikan eksekusi
        if (!empty($insufficientStock)) {
            $errorMessage = 'Stok produk berikut tidak mencukupi: ' . implode(', ', $insufficientStock) . '.';
            return redirect()->to('/')->with('error', $errorMessage);
        }

        // Jika semua stok cukup, lanjutkan menyimpan transaksi utama
        $transaksiData = [
            'id_cashier' => user()->id, // Ambil id kasir dari user yang login
            'pembayaran' => $pembayaran,
        ];
        $this->TransaksiModel->save($transaksiData);

        $transaksiId = $this->TransaksiModel->insertID();

        // Simpan detail transaksi dan kurangi stok produk
        for ($i = 0; $i < count($produkId); $i++) {
            $detailData = [
                'id_transaksi' => $transaksiId,
                'id_produk' => $produkId[$i],
                'jumlah' => $jumlah[$i],
                'harga' => $this->request->getVar('total')[$i],
            ];
            $this->TransaksiDetailModel->insert($detailData);

            // Kurangi stok produk
            $this->ProdukModel->update($produkId[$i], [
                'stok' => $produk['stok'] - $jumlah[$i]
            ]);
        }

        return redirect()->to('/')->with('success', 'Tagihan berhasil disimpan dan stok produk telah diperbarui.');
    }
}

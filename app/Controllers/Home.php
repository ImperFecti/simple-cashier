<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProdukModel;
use App\Models\TransaksiModel;

class Home extends BaseController
{
    protected $UserModel;
    protected $ProdukModel;
    protected $TransaksiModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->ProdukModel = new ProdukModel();
        $this->TransaksiModel = new TransaksiModel();
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
        $data = [
            'id_cashier' => user()->id, // Ambil id kasir dari user yang login
            'jumlah' => $this->request->getVar('jumlah'),
            'pembayaran' => $this->request->getVar('pembayaran'),
        ];

        $this->TransaksiModel->save($data);

        return redirect()->to('/home')->with('success', 'Tagihan berhasil disimpan.');
    }
}

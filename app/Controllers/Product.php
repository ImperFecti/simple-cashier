<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use CodeIgniter\HTTP\ResponseInterface;

class Product extends BaseController
{

    protected $ProdukModel;

    public function __construct()
    {
        $this->ProdukModel = new ProdukModel();
    }

    public function tableproduk()
    {
        $produk = $this->ProdukModel->getProduk();

        $data = [
            'title' => 'Table Produk',
            'produk' => $produk
        ];
        // dd($data);
        return view('pages/tableproduk', $data);
    }

    public function tambahproduk()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
        ];

        $this->ProdukModel->insert($data);

        return redirect()->to('/tableproduk')->with('message', 'Produk successfully added.');
    }

    public function editproduk($id)
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'nama' => $this->request->getPost('nama'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
        ];

        $this->ProdukModel->update($id, $data);
        return redirect()->to('/tableproduk')->with('message', 'Produk successfully updated.');
    }

    public function deleteproduk()
    {
        $id = $this->request->getPost('id');

        $this->ProdukModel->delete($id);

        return redirect()->to('/tableproduk')->with('message', 'Produk successfully deleted.');
    }
}

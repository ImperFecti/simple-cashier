<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pembayaran extends BaseController
{
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
    }

    public function tablepembayaran()
    {
        $data = [
            'title' => 'Data Kategori',
            'pembayaran' => $this->pembayaranModel->findAll()
        ];
        return view('pages/tablepembayaran', $data);
    }

    public function tambahpembayaran()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
        ];

        $this->pembayaranModel->insert($data);

        return redirect()->to('/tablepembayaran')->with('message', 'Pembayaran successfully added.');
    }

    public function editpembayaran($id)
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'nama' => $this->request->getPost('nama'),
        ];

        $this->pembayaranModel->update($id, $data);
        return redirect()->to('/tablepembayaran')->with('message', 'Pembayaran successfully updated.');
    }

    public function deletepembayaran()
    {
        $id = $this->request->getPost('id');
        $this->pembayaranModel->delete($id);
        return redirect()->to('/tablepembayaran')->with('message', 'Pembayaran successfully deleted.');
    }
}

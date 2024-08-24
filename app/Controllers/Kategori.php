<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use CodeIgniter\HTTP\ResponseInterface;

class Kategori extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function tablekategori()
    {
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'title' => 'Table Kategori',
            'kategori' => $kategori
        ];

        // dd($data);

        return view('pages/tablekategori', $data);
    }

    public function tambahkategori()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
        ];

        $this->kategoriModel->insert($data);

        return redirect()->to('/tablekategori')->with('message', 'Kategori successfully added.');
    }

    public function editkategori($id)
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'nama' => $this->request->getPost('nama'),
        ];

        $this->kategoriModel->update($id, $data);
        return redirect()->to('/tablekategori')->with('message', 'Kategori successfully updated.');
    }

    public function deletekategori()
    {
        $id = $this->request->getPost('id');
        $this->kategoriModel->delete($id);
        return redirect()->to('/tablekategori')->with('message', 'Kategori successfully deleted.');
    }
}

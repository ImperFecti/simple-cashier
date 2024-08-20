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

        // dd($data);

        return view('pages/tabletagihan', $data);
    }

    public function deletetagihan()
    {
        $id = $this->request->getPost('id');

        $this->tagihanModel->delete($id);

        return redirect()->to('/tabletagihan')->with('message', 'Tagihan berhasil dihapus.');
    }

    public function buktitagihan()
    {
        $data = [
            'title' => 'Bukti Tagihan'
        ];

        return view('pages/buktitagihan', $data);
    }
}

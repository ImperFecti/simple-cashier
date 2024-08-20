<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Tagihan extends BaseController
{
    public function buktitagihan()
    {
        $data = [
            'title' => 'Bukti Tagihan'
        ];

        return view('pages/buktitagihan', $data);
    }
}

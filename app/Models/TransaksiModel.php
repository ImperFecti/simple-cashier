<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['id_cashier', 'pembayaran', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getTransaksiWithCashier($id_transaksi = null)
    {
        $query = $this->select('transaksi.*, users.username as cashier_name')
            ->join('users', 'users.id = transaksi.id_cashier');

        if ($id_transaksi) {
            return $query->where('transaksi.id', $id_transaksi)->first();
        }

        return $query->findAll();
    }
}

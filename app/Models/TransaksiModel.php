<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['id_cashier', 'id_pembayaran', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getTransaksiWithCashier($id_transaksi = null)
    {
        $query = $this->select('transaksi.*, users.username as cashier_name, pembayaran.nama as nama_pembayaran')
            ->join('users', 'users.id = transaksi.id_cashier')
            ->join('pembayaran', 'pembayaran.id = transaksi.id_pembayaran');

        if ($id_transaksi) {
            return $query->where('transaksi.id', $id_transaksi)->first();
        }

        return $query->findAll();
    }

    public function getMetodePembayaranCount()
    {
        return $this->select('pembayaran.nama as nama_pembayaran, COUNT(transaksi.id) as jumlah')
            ->join('pembayaran', 'pembayaran.id = transaksi.id_pembayaran')
            ->groupBy('transaksi.id_pembayaran')
            ->findAll();
    }
}

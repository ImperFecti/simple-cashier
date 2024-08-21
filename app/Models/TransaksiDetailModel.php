<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiDetailModel extends Model
{
    protected $table            = 'transaksi_detail';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['id_transaksi', 'id_produk', 'jumlah', 'harga', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDetailTransaksiWithProduk($id_transaksi)
    {
        return $this->select('transaksi_detail.*, produk.nama as nama_produk, kategori.nama as nama_kategori')
            ->join('produk', 'produk.id = transaksi_detail.id_produk')
            ->join('kategori', 'kategori.id = produk.id_kategori')
            ->where('transaksi_detail.id_transaksi', $id_transaksi)
            ->findAll();
    }
}

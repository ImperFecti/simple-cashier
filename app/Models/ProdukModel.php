<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori', 'nama', 'deskripsi', 'harga', 'stok', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProduk()
    {
        return $this->select('produk.*, kategori.nama as kategori_name')
            ->join('kategori', 'kategori.id = produk.id_kategori', 'left')
            ->findAll();
    }

    public function getTopOrderedProducts($limit = 5)
    {
        return $this->select('produk.nama, SUM(transaksi_detail.jumlah) as total_pesanan')
            ->join('transaksi_detail', 'transaksi_detail.id_produk = produk.id')
            ->groupBy('produk.id')
            ->orderBy('total_pesanan', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}

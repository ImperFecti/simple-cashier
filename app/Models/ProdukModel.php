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
    protected $allowedFields    = ['id_kategori', 'nama', 'deksripsi', 'harga', 'stok', 'created_at', 'updated_at'];

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
}

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

    public function getPendapatanBulanan($year)
    {
        return $this->select('MONTH(transaksi.created_at) as bulan, SUM(transaksi_detail.harga) as total')
            ->join('transaksi', 'transaksi.id = transaksi_detail.id_transaksi')
            ->where('YEAR(transaksi.created_at)', $year)
            ->groupBy('bulan')
            ->findAll();
    }

    public function getPendapatanByMonth($year, $month)
    {
        return $this->selectSum('harga')
        ->join('transaksi', 'transaksi_detail.id_transaksi = transaksi.id')
        ->where('YEAR(transaksi.created_at)', $year)
            ->where('MONTH(transaksi.created_at)', $month)
            ->first()['harga'];
    }

    public function getTotalPendapatan()
    {
        return $this->selectSum('harga')
        ->join('transaksi', 'transaksi_detail.id_transaksi = transaksi.id')
        ->first()['harga'];
    }
}

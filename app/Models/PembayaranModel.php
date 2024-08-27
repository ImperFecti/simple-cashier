<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getNamaPembayaranById($id)
    {
        return $this->where('id', $id)->first();
    }

    // Fungsi untuk mendapatkan jumlah penggunaan metode pembayaran per bulan
    public function getMetodePembayaranCountByMonth($year, $month)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $builder->select('id_pembayaran, COUNT(*) as count');
        $builder->where('YEAR(created_at)', $year);
        $builder->where('MONTH(created_at)', $month);
        $builder->groupBy('id_pembayaran');

        return $builder->get()->getResultArray();
    }
}

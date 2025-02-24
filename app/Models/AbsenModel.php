<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $table            = 'absensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'tanggal', 'waktu_masuk', 'waktu_keluar', 'status', 'keterangan', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getAbsenWithUser($userId)
    {
        return $this->select('absensi.*, users.namalengkap')
            ->join('users', 'users.id = absensi.id_user')
            ->where('absensi.id_user', $userId)
            ->findAll();
    }
}

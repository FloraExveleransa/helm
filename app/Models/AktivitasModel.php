<?php

namespace App\Models;

use CodeIgniter\Model;

class AktivitasModel extends Model
{
    protected $table = 'hs_aktivitas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'nama_user', 'action', 'action_time', 'details'];

    // Fungsi untuk mendapatkan aktivitas berdasarkan ID pengguna
    public function getAktivitasByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    // Fungsi untuk mendapatkan semua aktivitas
    public function getAllAktivitas()
    {
        return $this->orderBy('action_time', 'DESC')->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pemohon_id', 'tgl_masak', 'menu_makan', 'jumlah_porsi', 'status', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
   

    public function getPermintaanWithDetails()
{
    $builder = $this->db->table('permintaan');
    $builder->select('permintaan.*, users.name as pemohon_name, permintaan_detail.jumlah_diminta, bahan_baku.nama as bahan_nama')
            ->join('users', 'users.id = permintaan.pemohon_id')
            ->join('permintaan_detail', 'permintaan_detail.permintaan_id = permintaan.id')
            ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id');
    return $builder->get()->getResultArray();
}

    public function getBahanTersedia()
    {
        $builder = $this->db->table('bahan_baku');
        $builder->where('status !=', 'habis');
        return $builder->get()->getResultArray();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pemohon_id', 'tgl_masak', 'menu_makan', 'jumlah_porsi', 'status', 'created_at', 'alasan_ditolak'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
   

    public function getPermintaanWithDetails()
    {
        $builder = $this->db->table('permintaan p');
        $builder->select('p.*, p.alasan_ditolak, users.name as pemohon_name, pd.jumlah_diminta, bb.nama as bahan_nama')
                ->join('users', 'users.id = p.pemohon_id')
                ->join('permintaan_detail pd', 'pd.permintaan_id = p.id')
                ->join('bahan_baku bb', 'bb.id = pd.bahan_id')
                ->orderBy('p.id', 'DESC');
        return $builder->get()->getResultArray();
    }

    public function getBahanTersedia()
    {
        $builder = $this->db->table('bahan_baku');
        $builder->where('status', 'tersedia');
        return $builder->get()->getResultArray();
    }
}
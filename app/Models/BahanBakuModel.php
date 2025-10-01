<?php
namespace App\Models;

use CodeIgniter\Model;

class BahanBakuModel extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'kategori', 'jumlah', 'satuan', 'tanggal_masuk', 'tanggal_kadaluarsa', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getWithStatus()
    {
        $bahan = $this->findAll();
        $today = date('Y-m-d'); 
        foreach ($bahan as &$item) {
            if ($item['jumlah'] == 0) {
                $item['status'] = 'habis';
            } elseif (strtotime($today) >= strtotime($item['tanggal_kadaluarsa'])) {
                $item['status'] = 'kadaluarsa';
            } elseif ((strtotime($item['tanggal_kadaluarsa']) - strtotime($today)) / 86400 <= 3 && $item['jumlah'] > 0) {
                $item['status'] = 'segera_kadaluarsa';
            } else {
                $item['status'] = 'tersedia';
            }
           
            $this->update($item['id'], ['status' => $item['status']]);
        }
        return $bahan;
    }
}
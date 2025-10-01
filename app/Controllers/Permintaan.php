<?php
namespace App\Controllers;

use App\Models\PermintaanModel;
use CodeIgniter\Controller;

class Permintaan extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new PermintaanModel();
        if (!session()->get('logged_in') || session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard/gudang')->with('error', 'Akses ditolak');
        }
    }

    public function index()
    {
        $data['permintaan'] = $this->model->getPermintaanWithDetails();
        $data['title'] = 'Lihat Status Permintaan';
        return view('permintaan/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Buat Permintaan';
        return view('permintaan/create', $data); 
    }
}
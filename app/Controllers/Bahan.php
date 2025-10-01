<?php
namespace App\Controllers;

use App\Models\BahanBakuModel;
use CodeIgniter\Controller;

class Bahan extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new BahanBakuModel();
        if (!session()->get('logged_in') || session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard/gudang')->with('error', 'Akses ditolak');
        }
    }

    public function index()
    {
        $data['bahan'] = $this->model->getWithStatus();  
        $data['title'] = 'Data Bahan Baku';
        return view('bahan/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Bahan Baku';
        return view('bahan/create', $data);
    }

    public function store()
    {
        $post = $this->request->getPost();
        $post['status'] = 'tersedia';  

        
        if (!isset($post['jumlah']) || $post['jumlah'] < 0) {
            return redirect()->back()->with('error', 'Jumlah harus lebih dari atau sama dengan 0');
        }
        if (strtotime($post['tanggal_kadaluarsa']) <= strtotime($post['tanggal_masuk'])) {
            return redirect()->back()->with('error', 'Tanggal kadaluarsa harus setelah tanggal masuk');
        }

        if ($this->model->insert($post)) {
            return redirect()->to('/bahan')->with('success', 'Bahan baku berhasil ditambahkan');  // Redirect ke /bahan
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan bahan: ' . implode(', ', $this->model->errors()));
        }
    }
}
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
        $data = $this->request->getPost();
        $data['status'] = 'tersedia';  

        if ($data['jumlah'] < 0) {
            return redirect()->back()->with('error', 'Jumlah tidak boleh negatif');
        }

        if ($this->model->save($data)) {
            return redirect()->to('/bahan')->with('success', 'Bahan baku berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan bahan: ' . $this->model->errors());
        }
    }
}
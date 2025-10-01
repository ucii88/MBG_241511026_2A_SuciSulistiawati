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
        if (!session()->get('logged_in') || session()->get('role') !== 'dapur') {
            return redirect()->to('/auth/login')->with('error', 'Akses ditolak');
        }
    }

    public function index()
    {
        $data['permintaan'] = $this->model->findAll();
        $data['title'] = 'Daftar Permintaan';
        return view('permintaan/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Permintaan';
        return view('permintaan/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        if ($this->model->save($data)) {
            return redirect()->to('/permintaan')->with('success', 'Permintaan berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan permintaan: ' . $this->model->errors());
        }
    }
}
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
            return redirect()->to('/bahan')->with('success', 'Bahan baku berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan bahan: ' . implode(', ', $this->model->errors()));
        }
    }

    public function edit($id)
    {
        $data['bahan'] = $this->model->find($id);
        $data['title'] = 'Edit Bahan Baku';
        if (!$data['bahan']) {
            return redirect()->to('/bahan')->with('error', 'Bahan tidak ditemukan');
        }
        return view('bahan/edit', $data);
    }

    public function update($id)
    {
        $post = $this->request->getPost();
        $bahanLama = $this->model->find($id);

        if (!isset($post['jumlah']) || $post['jumlah'] < 0) {
            return redirect()->back()->with('error', 'Jumlah harus lebih dari atau sama dengan 0');
        }
        if (strtotime($post['tanggal_kadaluarsa']) <= strtotime($post['tanggal_masuk'])) {
            return redirect()->back()->with('error', 'Tanggal kadaluarsa harus setelah tanggal masuk');
        }

        $today = date('Y-m-d');
        $status = 'tersedia';
        if ($post['jumlah'] <= 0) {
            $status = 'habis';
        } elseif (strtotime($today) >= strtotime($post['tanggal_kadaluarsa'])) {
            $status = 'kadaluarsa';
        } elseif ((strtotime($post['tanggal_kadaluarsa']) - strtotime($today)) / 86400 <= 3) {
            $status = 'segera_kadaluarsa';
        }
        $post['status'] = $status;

        if ($this->model->update($id, $post)) {
            return redirect()->to('/bahan')->with('success', 'Stok bahan berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui stok: ' . implode(', ', $this->model->errors()));
        }
    }

    public function delete($id)
    {
        $bahan = $this->model->find($id);
        if (!$bahan) {
            return redirect()->to('/bahan')->with('error', 'Bahan tidak ditemukan');
        }
        if ($bahan['status'] !== 'kadaluarsa') {
            return redirect()->to('/bahan')->with('error', 'Hanya bahan kadaluarsa yang bisa dihapus');
        }

        // Cek apakah bahan masih digunakan di permintaan
        if ($this->model->isUsedInPermintaan($id)) {
            return redirect()->to('/bahan')->with('error', 'Bahan tidak dapat dihapus karena masih terkait dengan data permintaan.');
        }

        if ($this->model->delete($id)) {
            return redirect()->to('/bahan')->with('success', 'Bahan berhasil dihapus');
        }
        
        return redirect()->to('/bahan')->with('error', 'Gagal menghapus bahan');
    }


}
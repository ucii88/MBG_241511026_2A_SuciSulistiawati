<?php
namespace App\Controllers;

use App\Models\PermintaanModel;
use App\Models\BahanBakuModel;
use CodeIgniter\Controller;

class Permintaan extends Controller
{
    protected $model;
    protected $bahanModel;
    protected $db;

    public function __construct()
    {
        $this->model = new PermintaanModel();
        $this->bahanModel = new BahanBakuModel();
        $this->db = \Config\Database::connect();
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Harap login terlebih dahulu');
        }
    }

public function index()
{
    $role = session()->get('role');
    if ($role === 'dapur') {
        $data['permintaan'] = $this->model->where('pemohon_id', session()->get('user_id'))
                                         ->select('permintaan.*, users.name as pemohon_name')
                                         ->join('users', 'users.id = permintaan.pemohon_id')
                                         ->findAll();
    } else if ($role === 'gudang') {
        $data['permintaan'] = $this->model->getPermintaanWithDetails();
    } else {
        return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
    }
    $data['title'] = 'Lihat Status Permintaan';
    return view('permintaan/index', $data);
}

    public function create()
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/dashboard/dapur')->with('error', 'Akses ditolak: Hanya Dapur yang boleh ajukan permintaan');
        }
        $data['bahan'] = $this->model->getBahanTersedia();
        $data['title'] = 'Buat Permintaan Bahan';
        return view('permintaan/create', $data);
    }

    public function store()
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/dashboard/dapur')->with('error', 'Akses ditolak: Hanya Dapur yang boleh ajukan permintaan');
        }
        $post = $this->request->getPost();
        $bahanIds = $this->request->getPost('bahan_id');
        $jumlahDiminta = $this->request->getPost('jumlah_diminta');

        $today = date('Y-m-d');
        if (strtotime($post['tgl_masak']) < strtotime($today)) {
            return redirect()->back()->with('error', 'Tanggal masak tidak boleh sebelum hari ini');
        }
        if (empty($bahanIds) || empty($jumlahDiminta)) {
            return redirect()->back()->with('error', 'Pilih setidaknya satu bahan dan jumlah');
        }

        $permintaanData = [
            'pemohon_id' => session()->get('user_id'),  
            'tgl_masak' => $post['tgl_masak'],
            'menu_makan' => $post['menu_makan'],
            'jumlah_porsi' => $post['jumlah_porsi'],
            'status' => 'menunggu'
        ];
        $permintaanId = $this->model->insert($permintaanData, true);

        $detailData = [];
        foreach ($bahanIds as $index => $bahanId) {
            if (!empty($bahanId) && !empty($jumlahDiminta[$index])) {
                $detailData[] = [
                    'permintaan_id' => $permintaanId,
                    'bahan_id' => $bahanId,
                    'jumlah_diminta' => $jumlahDiminta[$index]
                ];
            }
        }
        $this->db->table('permintaan_detail')->insertBatch($detailData);

        return redirect()->to('/permintaan')->with('success', 'Permintaan bahan berhasil dibuat');
    }
}
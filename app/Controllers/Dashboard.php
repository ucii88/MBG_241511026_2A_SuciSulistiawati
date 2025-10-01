<?php
namespace App\Controllers;

use App\Models\BahanBakuModel;
use App\Models\PermintaanModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    protected $bahanModel;
    protected $permintaanModel;

    public function __construct()
    {
        $this->bahanModel = new BahanBakuModel();
        $this->permintaanModel = new PermintaanModel();
        if (!session()->get('logged_in') || session()->get('role') !== 'gudang') {
            return redirect()->to('/auth/login')->with('error', 'Akses ditolak');
        }
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $data['title'] = 'Dashboard';
        if (session()->get('role') === 'gudang') {
            return redirect()->to('/dashboard/gudang');
        } else {
            return redirect()->to('/permintaan/create');
        }
    }

    public function gudang()
{
    if (session()->get('role') !== 'gudang') {
        return redirect()->to('/dashboard/dapur');
    }
    $data['title'] = 'Dashboard Gudang';
    return view('dashboard/gudang', $data);
}
}
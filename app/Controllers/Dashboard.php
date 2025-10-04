<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }
        $role = session()->get('role');
        if ($role === 'gudang') {
            return redirect()->to('/dashboard/gudang');
        } elseif ($role === 'dapur') {
            return redirect()->to('/dashboard/dapur');
        }
        return view('dashboard/index');
    }

    public function gudang()
    {
        if (session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }
        
        $permintaanModel = new \App\Models\PermintaanModel();
        $data['title'] = 'Dashboard Gudang';
        $data['permintaan'] = $permintaanModel->getPermintaanWithDetails();
        
       
        $data['total_menunggu'] = 0;
        $data['total_disetujui'] = 0;
        $data['total_ditolak'] = 0;
        
        $counted_requests = [];
        foreach ($data['permintaan'] as $item) {
            if (!in_array($item['id'], $counted_requests)) {
                if ($item['status'] === 'menunggu') {
                    $data['total_menunggu']++;
                } elseif ($item['status'] === 'disetujui') {
                    $data['total_disetujui']++;
                } elseif ($item['status'] === 'ditolak') {
                    $data['total_ditolak']++;
                }
                $counted_requests[] = $item['id'];
            }
        }
        
        return view('dashboard/gudang', $data);
    }

    public function dapur()
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }
        $data['title'] = 'Dashboard Dapur';
        return view('dashboard/dapur', $data);
    }
}
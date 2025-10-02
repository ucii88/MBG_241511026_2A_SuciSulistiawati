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
        $data['title'] = 'Dashboard Gudang';
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
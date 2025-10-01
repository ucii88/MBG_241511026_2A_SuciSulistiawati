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

        $data['title'] = 'Dashboard';
        if (session()->get('role') === 'gudang') {
            return view('dashboard/gudang', $data);
        } else {
            return view('dashboard/dapur', $data);
        }
    }
}
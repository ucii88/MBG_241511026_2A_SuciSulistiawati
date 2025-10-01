<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('login', ['title' => 'Login']);
    }

    public function attemptLogin()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

    
        log_message('debug', 'Input email: ' . $email . ', password: ' . $password);

        $user = $model->where('email', $email)->first();

     
        if ($user && password_verify($password, $user['password'])) {
            log_message('debug', 'Login berhasil untuk: ' . $user['email']);
            session()->set([
                'user_id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => true
            ]);

            if ($user['role'] === 'gudang') {
                return redirect()->to('/dashboard/gudang');
            } else {
                return redirect()->to('/dashboard/dapur');
            }
        }

        log_message('debug', 'Login gagal untuk email: ' . $email);
        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
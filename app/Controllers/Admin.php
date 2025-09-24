<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Admin extends Controller
{
    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        $role = $session->get('role');
        if ($role === 'student') {
            return redirect()->to('/student/dashboard');
        } elseif ($role === 'teacher') {
            return redirect()->to('/teacher/dashboard');
        } elseif ($role !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }

        $userModel   = new UserModel();

        $data = [
            'totalUsers'   => $userModel->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}

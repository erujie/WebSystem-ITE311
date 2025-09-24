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

        $userModel   = new UserModel();

        $data = [
            'totalUsers'   => $userModel->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}

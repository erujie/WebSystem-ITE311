<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    public function dashboard()
    {
        $session = session();

        // check login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        // check role
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Unauthorized access.');
        }

        return view('admin/dashboard');
    }
}

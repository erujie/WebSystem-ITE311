<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Teacher extends Controller
{
    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        if ($session->get('role') !== 'teacher') {
            return redirect()->to('/login')->with('error', 'Unauthorized access.');
        }

        return view('teacher/dashboard');
    }
}

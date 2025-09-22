<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Student extends Controller
{
    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        if ($session->get('role') !== 'student') {
            return redirect()->to('/login')->with('error', 'Unauthorized access.');
        }

        return view('student/dashboard');
    }
}

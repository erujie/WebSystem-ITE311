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

        return view('student/dashboard');
    }
}

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

        $role = $session->get('role');
        if ($role === 'admin') {
            return redirect()->to('/admin/dashboard');
        } elseif ($role === 'teacher') {
            return redirect()->to('/teacher/dashboard');
        } elseif ($role !== 'student') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }

        return view('student/dashboard');
    }
}

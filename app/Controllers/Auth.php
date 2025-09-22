<?php

namespace App\Controllers;

use App\Models\UserModel; 
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function register()
    {
            helper(['form']);

            if ($this->request->getMethod() === 'POST') {
                $rules = [
                     'name'              => 'required|min_length[3]',
                     'email'             => 'required|valid_email|is_unique[users.email]',
                     'password'          => 'required|min_length[6]',
                     'password_confirm'  => 'matches[password]'
                ];

                if ($this->validate($rules)) {
                    $userModel = new \App\Models\UserModel();
                    $userModel->save([
                        'name'     => $this->request->getVar('name'),
                        'email'    => $this->request->getVar('email'),
                        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                        'role'     => 'student'
                    ]);

                    return redirect()->to('/login')->with('success', 'Registration successful.');
                } else {
                    return view('auth/register', ['validation' => $this->validator]);
                }
            }

            return view('auth/register');
    }

    public function login()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'POST') {
            $session   = session();
            $userModel = new UserModel();

            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[6]',
            ];

            if (!$this->validate($rules)) {
                return view('auth/login', ['validation' => $this->validator]);
            }

            $user = $userModel->where('email', $this->request->getVar('email'))->first();

            if ($user && password_verify($this->request->getVar('password'), $user['password'])) {
                $session->set([
                    'userID'    => $user['id'],
                    'name'      => $user['name'],
                    'email'    => $user['email'],
                    'role'      => $user['role'],
                    'isLoggedIn'=> true
                ]);
                $session->setFlashdata('success', 'Welcome ' . $user['name']);
                return redirect()->to('dashboard');
            }

            $session->setFlashdata('error', 'Invalid login credentials');
            return redirect()->back();
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }
        return view('dashboard');
    }
}

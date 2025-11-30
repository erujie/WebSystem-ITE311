<?php

namespace App\Controllers;

use App\Models\UserModel; 

class Auth extends BaseController
{
    public function register()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                    'name'              => 'required|min_length[3]',
                    'email'             => 'required|valid_email|is_unique[users.email]',
                    'password'          => 'required|min_length[3]',
                    'password_confirm'  => 'matches[password]'
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();
                $userModel->save([
                    'name'     => $this->request->getPost('name'),
                    'email'    => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'     => $this->request->getPost('role') ?? 'student'
                ]);

                return redirect()->to('/login');
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
                'password' => 'required|min_length[3]',
            ];

            if (!$this->validate($rules)) {
                return view('auth/login', ['validation' => $this->validator]);
            }

            $user = $userModel->where('email', $this->request->getPost('email'))->first();

            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                $session->set([
                    'userID'    => $user['id'],
                    'name'      => $user['name'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'isLoggedIn'=> true
                ]);
                /* Role based for midterm exam-----------------------------------------------------------
                if (strtolower($user['role']) === 'student') {
                    return redirect()->to('/announcements');
                } elseif (strtolower($user['role']) === 'teacher') {
                    return redirect()->to('/teacher/dashboard');
                } elseif (strtolower($user['role']) === 'admin') {
                    return redirect()->to('/admin/dashboard');
                } else {*/
                    return redirect()->to('/dashboard');
                //}
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

        $session = session();
        $role = $session->get('role');
        $user_id = $session->get('userID');

        $userModel = new UserModel();

        $data = ['role' => $role];

        if ($role === 'admin') {
            $data['totalUsers'] = $userModel->countAllResults();
            $courseModel = new \App\Models\CourseModel();
            $data['courses'] = $courseModel->getAllCourses();
            $data['totalCourses'] = count($data['courses']);
        } elseif ($role === 'teacher') {
            $courseModel = new \App\Models\CourseModel();
            $data['courses'] = $courseModel->getAllCourses();
        } elseif ($role === 'student') {
            $enrollmentModel = new \App\Models\EnrollmentModel();
            $courseModel = new \App\Models\CourseModel();
            $materialModel = new \App\Models\MaterialModel();

            $enrolledCourses = $enrollmentModel->getUserEnrollments($user_id);
            $allCourses = $courseModel->getAllCourses();

            $enrolledCourseIds = array_column($enrolledCourses, 'course_id');
            $data['enrolledCourses'] = $enrolledCourses;
            $data['availableCourses'] = array_filter($allCourses, function($course) use ($enrolledCourseIds) {
                return !in_array($course['id'], $enrolledCourseIds);
            });

            $materials = [];
            foreach ($enrolledCourseIds as $courseId) {
                $materials = array_merge($materials, $materialModel->getMaterialsByCourse($courseId));
            }
            $data['materials'] = $materials;
        }

        return view('templates/header', $data)
            . view('auth/dashboard')
            . view('templates/footer');
    }
}

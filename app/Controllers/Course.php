<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;

class Course extends BaseController
{
    public function enroll()
    {
        $session = session();
        $enrollmentModel = new EnrollmentModel();

        if (!$session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'You must be logged in to enroll.'
            ]);
        }

        $user_id = $session->get('userID');
        $course_id = $this->request->getPost('course_id');

        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'You are already enrolled in this course.'
            ]);
        }

        $data = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s')
        ];

        if ($enrollmentModel->enrollUser($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Enrollment successful!'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Enrollment failed. Please try again.'
        ]);
    }
}

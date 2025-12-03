<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\NotificationModel;
use App\Models\CourseModel;

class Course extends BaseController
{
    public function index()
    {
        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->getAllCourses();

        return view('courses/index', $data);
    }

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
            // Create notification for the student
            $courseModel = new CourseModel();
            $course = $courseModel->find($course_id);

            if ($course) {
                $notificationModel = new NotificationModel();
                $notificationData = [
                    'user_id' => $user_id,
                'message' => 'You have been enrolled in ' . $course['course_name'],
                    'is_read' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $notificationModel->insert($notificationData);
            }

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

    public function search()
    {
        $searchTerm = $this->request->getGet('search_term');
        $courseModel = new CourseModel();

        if (!empty($searchTerm)) {
            $courseModel->like('course_name', $searchTerm);
            $courseModel->orLike('course_description', $searchTerm);
        }

        $courses = $courseModel->findAll();

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($courses);
        }

        return view('courses/search_results', ['courses' => $courses, 'searchTerm' => $searchTerm]);
    }
}

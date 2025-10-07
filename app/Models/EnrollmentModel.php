<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrollment_date'];
    protected $useTimestamps = false;

    /**
     * Insert a new enrollment record.
     * Returns inserted ID or false.
     */
    public function enrollUser(array $data)
    {
        return $this->insert($data);
    }

    /**
     * Return boolean whether the user is already enrolled in that course.
     */
    public function isAlreadyEnrolled(int $user_id, int $course_id): bool
    {
        return (bool) $this->where(['user_id' => $user_id, 'course_id' => $course_id])->countAllResults();
    }

    /**
     * Fetch all courses a user is enrolled in (joins with courses table).
     * Returns array of enrollments with course info.
     */
    public function getUserEnrollments(int $user_id): array
    {
        return $this->select('enrollments.*, courses.id as course_id, courses.title as course_title')
                    ->join('courses', 'courses.id = enrollments.course_id', 'left')
                    ->where('enrollments.user_id', $user_id)
                    ->orderBy('enrollment_date', 'DESC')
                    ->findAll();
    }
}

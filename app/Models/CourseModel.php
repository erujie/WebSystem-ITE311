<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['course_name', 'course_description', 'created_at', 'updated_at'];
    protected $useTimestamps = true;


    public function getAllCourses(): array
    {
        return $this->findAll();
    }
}

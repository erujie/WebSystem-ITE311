<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    /**
     * Get all courses
     */
    public function getAllCourses(): array
    {
        return $this->findAll();
    }
}

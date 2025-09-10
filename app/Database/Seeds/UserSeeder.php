<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'     => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin',
            ],
            [
                'name'     => 'instructor',
                'email'    => 'instructor@gmail.com',
                'password' => password_hash('instructor123', PASSWORD_DEFAULT),
                'role'     => 'user',
            ],
            [
                'name'     => 'student',
                'email'    => 'student@gmail.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role'     => 'user',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}

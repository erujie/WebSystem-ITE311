<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
            ],
            [
                'name' => 'student',
                'email'    => 'student@gmail.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role' => 'user',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}

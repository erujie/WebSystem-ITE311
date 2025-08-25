<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email'    => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
            ],
            [
                'username' => 'student1',
                'email'    => 'student1@example.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}

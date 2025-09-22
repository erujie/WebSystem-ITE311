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
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'role'     => 'admin',
            ],
            [
                'name'     => 'instructor',
                'email'    => 'instructor@gmail.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'role'     => 'teacher',
            ],
            [
                'name'     => 'student',
                'email'    => 'student@gmail.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'role'     => 'student',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}

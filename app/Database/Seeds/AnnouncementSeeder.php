<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Welcome to the School Portal',
                'content' => 'We are excited to launch our new school portal! This platform will help students stay informed with the latest announcements and updates.',
            ],
            [
                'title' => 'First Day of Classes Reminder',
                'content' => 'Classes begin on Monday. Please ensure you have all required materials and arrive 15 minutes early for orientation.',
            ],
        ];

        $this->db->table('announcements')->insertBatch($data);
    }
}

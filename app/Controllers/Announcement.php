<?php

namespace App\Controllers;

class Announcement extends BaseController
{
    public function index()
    {
        $announcementModel = new \App\Models\AnnouncementModel();
        $data['announcements'] = $announcementModel->orderBy('created_at', 'DESC')->findAll();

        return view('announcements', $data);
    }
}

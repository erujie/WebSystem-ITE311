<?php

namespace App\Controllers;

class Announcement extends BaseController
{
    public function index()
    {
        $announcementModel = new \App\Models\AnnouncementModel();
        $data['announcements'] = $announcementModel->findAll();

        return view('announcements', $data);
    }
}

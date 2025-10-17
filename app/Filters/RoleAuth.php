<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $role = $session->get('role');
        $uri = $request->getUri();
        $path = $uri->getPath();

        // Normalize path for subfolder installations
        $path = preg_replace('#^/ITE311-DOSDOS#', '', $path);

        if (strtolower($role) === 'admin') {
            if (!str_starts_with($path, '/admin')) {
                $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to('/announcements');
            }
        } elseif (strtolower($role) === 'teacher') {
            if (!str_starts_with($path, '/teacher')) {
                $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to('/announcements');
            }
        } elseif (strtolower($role) === 'student') {
            if (!str_starts_with($path, '/student') && $path !== '/announcements') {
                $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to('/announcements');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after
    }
}

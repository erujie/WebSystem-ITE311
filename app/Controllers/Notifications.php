<?php

namespace App\Controllers;

use App\Models\NotificationModel;

class Notifications extends BaseController
{
    public function get()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return $this->response->setJSON(['error' => 'Not logged in']);
        }

        $notificationModel = new NotificationModel();
        $userId = $session->get('userID');

        $unreadCount = $notificationModel->getUnreadCount($userId);
        $notifications = $notificationModel->getNotificationsForUser($userId);

        return $this->response->setJSON([
            'unread_count' => $unreadCount,
            'notifications' => $notifications
        ]);
    }

    public function mark_as_read($id)
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Not logged in']);
        }

        $notificationModel = new NotificationModel();
        $userId = $session->get('userID');

        // Verify the notification belongs to the current user
        $notification = $notificationModel->find($id);
        if (!$notification || $notification['user_id'] != $userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Notification not found']);
        }

        $success = $notificationModel->markAsRead($id);

        return $this->response->setJSON([
            'success' => $success,
            'message' => $success ? 'Notification marked as read' : 'Failed to mark as read'
        ]);
    }
}

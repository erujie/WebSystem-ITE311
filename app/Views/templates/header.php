<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container-fluid">
    <div class="navbar-brand">ITE311</div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell"></i>
            <span class="badge bg-danger" id="notificationBadge" style="display: none;"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="notificationDropdown" id="notificationList">
            <li class="dropdown-item text-muted">Loading notifications...</li>
          </ul>
        </li>

        <?php if ($role === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('/dashboard') ?>">Dashboard</a></li>

        <?php elseif ($role === 'teacher'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="#">New Courses</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Assignments Notifications</a></li>

        <?php elseif ($role === 'student'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="#">My Classes</a></li>
          <li class="nav-item"><a class="nav-link" href="#">My Grades</a></li>
        <?php endif; ?>

        <li class="btn btn-danger btn-sm py-0 px-0"><a class="nav-link" href="<?= base_url('logout') ?>">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">

<script>
$(document).ready(function() {
    var baseUrl = '<?= base_url() ?>';

    function loadNotifications() {
        $.get(baseUrl + 'notifications', function(data) {
            if (data.error) {
                console.log('Error loading notifications:', data.error);
                return;
            }

            if (data.unread_count > 0) {
                $('#notificationBadge').text(data.unread_count).show();
            } else {
                $('#notificationBadge').hide();
            }

            var notificationList = $('#notificationList');
            notificationList.empty();

            if (data.notifications.length > 0) {
                data.notifications.forEach(function(notification) {
                    var alertClass = notification.is_read ? 'alert-secondary' : 'alert-info';
                    var itemHtml = '<li class="p-2">' +
                        '<div class="alert ' + alertClass + ' mb-1 small">' +
                        '<div class="d-flex justify-content-between align-items-start">' +
                        '<div class="flex-grow-1 small">' + notification.message + '</div>' +
                        '<button class="btn btn-sm btn-outline-primary ms-2 mark-read-btn" data-id="' + notification.id + '">Mark Read</button>' +
                        '</div>' +
                        '<small class="text-muted d-block mt-1">' + new Date(notification.created_at).toLocaleDateString() + '</small>' +
                        '</div></li>';
                    notificationList.append(itemHtml);
                });
            } else {
                notificationList.append('<li class="dropdown-item text-muted">No notifications</li>');
            }
        }).fail(function() {
            console.log('Failed to load notifications');
        });
    }

    loadNotifications();

    $(document).on('click', '.mark-read-btn', function(e) {
        e.stopPropagation();
        var notificationId = $(this).data('id');
        var listItem = $(this).closest('li');

        $.post(baseUrl + 'notifications/mark_read/' + notificationId, function(data) {
            if (data.success) {
                listItem.remove();

                var currentCount = parseInt($('#notificationBadge').text()) || 0;
                if (currentCount > 1) {
                    $('#notificationBadge').text(currentCount - 1);
                } else {
                    $('#notificationBadge').hide();
                }
            } else {
                console.log('Failed to mark notification as read:', data.message);
            }
        }).fail(function() {
            console.log('Failed to mark notification as read');
        });
    });

    setInterval(loadNotifications, 60000);
});
</script>

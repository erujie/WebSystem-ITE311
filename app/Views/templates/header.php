<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Dashboard' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-sm">
    <a class="navbar-brand" href="#">ITE311</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <!-- Admin Menu -->
        <?php if (session()->get('role') === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/dashboard') ?>">Admin Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Manage Users</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Manage Courses</a></li>
        <?php endif; ?>

        <!-- Teacher Menu -->
        <?php if (session()->get('role') === 'teacher'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('teacher/dashboard') ?>">Teacher Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="#">My Courses</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Assignments</a></li>
        <?php endif; ?>

        <!-- Student Menu -->
        <?php if (session()->get('role') === 'student'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('student/dashboard') ?>">Student Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="#">My Classes</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Grades</a></li>
        <?php endif; ?>

        <!-- Common Menu -->
        <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('logout') ?>">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">

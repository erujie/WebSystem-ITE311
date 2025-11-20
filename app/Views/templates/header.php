<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

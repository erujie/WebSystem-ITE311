<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    <h4>User Registration</h4>
                </div>
                <div class="card-body">
                    
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('register') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name"
                                   class="form-control"
                                   value="<?= set_value('name') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"
                                   class="form-control"
                                   value="<?= set_value('email') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm">Confirm Password</label>
                            <input type="password" name="password_confirm" id="password_confirm"
                                   class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">Register</button>
                    </form>
                </div>
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="student" <?php if (set_value('role') == 'student' || !set_value('role')) echo 'selected'; ?>>Student</option>
                                <option value="teacher" <?php if (set_value('role') == 'teacher') echo 'selected'; ?>>Teacher</option>
                                <option value="admin" <?php if (set_value('role') == 'admin') echo 'selected'; ?>>Admin</option>
                            </select>
                        </div>

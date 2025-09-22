<?= $this->include('templates/header') ?>

    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <p><?= $totalUsers ?? 'N/A' ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Total Courses</h5>
                    <p><?= $totalCourses ?? 'N/A' ?></p>
                </div>
            </div>
        </div>
    </div>

    <a href="<?= base_url('logout') ?>" class="btn btn-danger mt-3">Logout</a>

</div>

<?= $this->include('templates/footer') ?>
<?= $this->include('templates/header') ?>

//Admin--------------------------------------------------------------
<?php if ($role === 'admin'): ?>
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-dark">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <p><?= $totalUsers ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-dark">
                <div class="card-body">
                    <h5>Total Courses</h5>
                    <p>Empty</p>
                </div>
            </div>
        </div>
        <div class="mb-4"></div>
    </div>

    <div class="card">
        <div class="card-header">Recent Activity</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                    </tr>
                </tbody>
                <tfoot>
                    <th class="text-center">No recent activity</th>
                </tfoot>
            </table>
        </div>
    </div>

//Teacher----------------------------------------------------------
<?php elseif ($role === 'teacher'): ?>
    <h1 class="mb-4">Teacher Dashboard</h1>

    <h3>Courses List</h3>
    <ul class="list-group">
            <li class="list-group-item">No courses assigned.</li>
    </ul>
 
//Student-----------------------------------------------------------
<?php elseif ($role === 'student'): ?>
    <h1 class="mb-4">Student Dashboard</h1>

    <h3>Enrolled Courses</h3>
    <ul class="list-group">
            <li class="list-group-item">No enrolled courses.</li>
    </ul>

    <h3 class="mt-4">Upcoming Deadlines</h3>
    <ul class="list-group">
        <li class="list-group-item active">Lab 5 - Due: Friday by 1pm</li>
    </ul>
<?php endif; ?>

<?= $this->include('templates/footer') ?>

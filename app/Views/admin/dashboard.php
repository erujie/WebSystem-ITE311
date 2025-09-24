<?= $this->include('templates/header') ?>

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
                    <p><?= $totalCourses ?></p>
                </div>
            </div>
        </div>
        <div class="mb-4"></div>

    </div>
    
    <div></div>
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

<?= $this->include('templates/footer') ?>

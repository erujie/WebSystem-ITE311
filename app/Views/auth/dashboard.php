 <?php if ($role === 'admin'): ?>
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row">
        <div class="col-lg-3">
            <div class="card border-dark">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <p><?= $totalUsers ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card border-dark">
                <div class="card-body">
                    <h5>Total Courses</h5>
                    <p><?= $totalCourses ?></p>
                </div>
            </div>
        </div>
        <div class="mb-4"></div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Manage Courses</div>
        <div class="card-body">
            <?php if (!empty($courses)): ?>
                <div class="row">
                    <?php foreach ($courses as $course): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo esc($course['title']); ?></h5>
                                    <a href="<?= base_url('admin/course/' . $course['id'] . '/upload') ?>" class="btn btn-primary">Upload Materials</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No courses available.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card mt-4">
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

<?php elseif ($role === 'teacher'): ?>
    <h1 class="mb-4">Teacher Dashboard</h1>

    <div class="card mt-4">
        <div class="card-header">Manage Courses</div>
        <div class="card-body">
            <?php if (!empty($courses)): ?>
                <div class="row">
                    <?php foreach ($courses as $course): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo esc($course['title']); ?></h5>
                                    <a href="<?= base_url('admin/course/' . $course['id'] . '/upload') ?>" class="btn btn-primary">Upload Materials</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No courses available.</p>
            <?php endif; ?>
        </div>
    </div>
 
<?php elseif ($role === 'student'): ?>
    <h1 class="mb-4">Student Dashboard</h1>

    <div id="enrolledCoursesContainer">
        <h3>Enrolled Courses</h3>
        <?php if (!empty($enrolledCourses)): ?>
            <div class="row" id="enrolledCoursesRow">
                <?php foreach ($enrolledCourses as $enrollment): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo esc($enrollment['course_title']); ?></h5>
                                <p class="card-text">Enrolled on: <?php echo date('M d, Y', strtotime($enrollment['enrollment_date'])); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info" id="noEnrolledAlert">No enrolled courses yet.</div>
        <?php endif; ?>
    </div>

    <div id="availableCoursesContainer">
        <h3 class="mt-4">Available Courses</h3>
        <?php if (!empty($availableCourses)): ?>
            <div class="row">
                <?php foreach ($availableCourses as $course): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo esc($course['title']); ?></h5>
                                <button type="button" class="btn btn-primary enroll-btn" data-course-id="<?php echo $course['id']; ?>">Enroll</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">All courses are enrolled.</div>
        <?php endif; ?>

    <div id="downloadableMaterialsContainer">
        <h3 class="mt-4">Downloadable Materials</h3>
        <?php if (!empty($materials)): ?>
            <div class="row">
                <?php foreach ($materials as $material): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo esc($material['file_name']); ?></h5>
                                <p class="card-text">Uploaded: <?php echo date('M d, Y', strtotime($material['created_at'])); ?></p>
                                <a href="/materials/download/<?php echo $material['id']; ?>" class="btn btn-primary">Download</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No materials available yet.</div>
        <?php endif; ?>
    </div>

    <h3 class="mt-4">Upcoming Deadlines</h3>
    <ul class="list-group">
        <li class="list-group-item active">Lab 5 - Due: Friday by 1pm</li>
    </ul>

    <script>
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    $(document).ready(function() {
        $('.enroll-btn').on('click', function(e) {
            e.preventDefault();
            var courseId = $(this).data('course-id');
            var btn = $(this);
            var csrfToken = getCookie('csrf_cookie_name');

            $.post('<?= base_url("course/enroll") ?>', { course_id: courseId, csrf_test_name: csrfToken }, function(response) {
                if (response.status === 'success') {
                    // Disable the button
                    btn.prop('disabled', true).text('Enrolled');

                    // Display Bootstrap success alert
                    $('<div class="alert alert-success alert-dismissible fade show">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>')
                        .prependTo('#enrolledCoursesContainer')
                        .delay(3000).fadeOut();

                    // Update Enrolled Courses list
                    var courseTitle = btn.closest('.card').find('.card-title').text();
                    var cardHtml = '<div class="col-md-4 mb-3"><div class="card"><div class="card-body"><h5 class="card-title">' + courseTitle + '</h5><p class="card-text">Enrolled on: ' + new Date().toLocaleDateString() + '</p></div></div></div>';
                    var enrolledRow = $('#enrolledCoursesRow');
                    if (enrolledRow.length > 0) {
                        enrolledRow.append(cardHtml);
                    } else {
                        $('#noEnrolledAlert').replaceWith('<div class="row" id="enrolledCoursesRow">' + cardHtml + '</div>');
                    }
                } else {
                    // Display Bootstrap error alert
                    $('<div class="alert alert-danger">' + response.message + '</div>')
                        .prependTo('#availableCoursesContainer')
                        .delay(3000).fadeOut();
                }
            }, 'json')
            .fail(function() {
                $('<div class="alert alert-danger">An error occurred. Please try again.</div>')
                    .prependTo('#availableCoursesContainer')
                    .delay(3000).fadeOut();
            });
        });
    });
    </script>
<?php endif; ?>

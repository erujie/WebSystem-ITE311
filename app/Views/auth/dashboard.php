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

<?php elseif ($role === 'teacher'): ?>
    <h1 class="mb-4">Teacher Dashboard</h1>

    <h3>Courses List</h3>
    <ul class="list-group">
            <li class="list-group-item">No courses assigned.</li>
    </ul>
 
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
    <?php
    // Get enrolled course IDs
    $enrolledCourseIds = array_column($enrolledCourses ?? [], 'course_id');

    // Sample available courses (replace with dynamic data later)
    $availableCourses = [
        ['id' => 1, 'title' => 'Introduction to Programming'],
        ['id' => 2, 'title' => 'Web Development Fundamentals'],
        ['id' => 3, 'title' => 'Database Management'],
        ['id' => 4, 'title' => 'Software Engineering']
    ];

    $availableToDisplay = array_filter($availableCourses, function($course) use ($enrolledCourseIds) {
        return !in_array($course['id'], $enrolledCourseIds);
    });
    ?>
    <?php if (!empty($availableToDisplay)): ?>
        <div class="row">
            <?php foreach ($availableToDisplay as $course): ?>
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

    <h3 class="mt-4">Upcoming Deadlines</h3>
    <ul class="list-group">
        <li class="list-group-item active">Lab 5 - Due: Friday by 1pm</li>
    </ul>

    <script>
    $(document).ready(function() {
        $('.enroll-btn').on('click', function(e) {
            e.preventDefault();
            var courseId = $(this).data('course-id');
            var btn = $(this);

            $.post('<?= base_url("course/enroll") ?>', { course_id: courseId }, function(response) {
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

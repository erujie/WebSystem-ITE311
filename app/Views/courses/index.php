<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Available Courses</h1>


        <div class="row mb-4">
            <div class="col-md-6">
                <form id="searchForm" class="d-flex">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control"
                            placeholder="Search courses..." name="search_term">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
        



        <div id="coursesContainer" class="row">
            <?php foreach ($courses as $course): ?>
                <div class="col-md-4 mb-4">
                    <div class="card course-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $course['course_name'] ?></h5>
                            <p class="card-text"><?= $course['course_description'] ?></p>
                            <a href="/courses/view/<?= $course['id'] ?>" class="btn btn-primary">View Course</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>




        <script>
        $(document).ready(function() {
            var baseUrl = '<?= base_url() ?>';
            // Client-side filtering
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('.course-card').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Server-side search with AJAX
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                var searchTerm = $('#searchInput').val();

                $.get( baseUrl + '/courses/search', {search_term: searchTerm}, function(data) {
                    $('#coursesContainer').empty();

                    if (data.length > 0) {
                        $.each(data, function(index, course) {
                            var courseHtml = `
                                <div class="col-md-4 mb-4">
                                    <div class="card course-card">
                                        <div class="card-body">
                                            <h5 class="card-title">${course.course_name}</h5>
                                            <p class="card-text">${course.course_description}</p>
                                            <a href="/courses/view/${course.id}" class="btn btn-primary">View Course</a>
                                        </div>
                                    </div>
                                </div>`;
                            $('#coursesContainer').append(courseHtml);
                        });
                    } else {
                        $('#coursesContainer').html('<div class="col-12"><div class="alert alert-info">No courses found matching your search.</div></div>');
                    }
                });
            });
        });
        </script>




    </div>
</body>
</html>

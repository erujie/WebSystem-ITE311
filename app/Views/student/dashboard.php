<?= $this->include('templates/header') ?>

    <h1 class="mb-4">Student Dashboard</h1>

    <h3>Enrolled Courses</h3>
    <ul>
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <li><?= $course ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No enrolled courses yet.</li>
        <?php endif; ?>
    </ul>

    <h3 class="mt-4">Upcoming Deadlines</h3>
    <ul>
        <?php if (!empty($deadlines)): ?>
            <?php foreach ($deadlines as $d): ?>
                <li><?= $d ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No deadlines available.</li>
        <?php endif; ?>
    </ul>

    <a href="<?= base_url('logout') ?>" class="btn btn-danger mt-3">Logout</a>

</div>

<?= $this->include('templates/footer') ?>

<?= $this->include('templates/header') ?>

    <h1 class="mb-4">Teacher Dashboard</h1>

    <h3>Your Courses</h3>
    <ul>
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <li><?= $course ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No courses assigned.</li>
        <?php endif; ?>
    </ul>

    <a href="<?= base_url('logout') ?>" class="btn btn-danger mt-3">Logout</a>

</div>

</body>
</html>

<div class="container mt-5">
    <h1>Announcements</h1>
    <?php if (!empty($announcements)): ?>
        <div class="list-group">
            <?php foreach ($announcements as $ann): ?>
                <div class="list-group-item mb-3">
                    <h5 class="mb-1"><?php echo esc($ann['title']); ?></h5>
                    <p class="mb-1"><?php echo esc($ann['content']); ?></p>
                    <small class="text-muted">Posted on: <?php echo date('F j, Y', strtotime($ann['created_at'])); ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-muted">No announcements available at the moment.</p>
    <?php endif; ?>
</div>

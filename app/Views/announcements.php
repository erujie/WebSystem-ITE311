<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Posts Lists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Task Manager</h1>
    <a href="/post/create" class="btn btn-primary mb-3">New Task</a>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>    
    <?php endif; ?>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><?= $post['title'] ?></td>
                <td><?= $post['body'] ?></td>
                <td>
                    <a href="/post/edit/<?= $post['id'] ?>" class="btn btn-warning">Edit</a>
                    <a href="/post/delete/<?= $post['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
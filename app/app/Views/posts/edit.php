<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Post</h1>
    <form method="post" action="/posts/update/<?= $post['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= $post['title'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="body" class="form-control" rows="3"><?= $post['body'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>
</body>
</html>
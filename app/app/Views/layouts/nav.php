<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url('/') ?>">IC4</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ps-5">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo base_url('/') ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('users') ?>">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('posts') ?>">Posts</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
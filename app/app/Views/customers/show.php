<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
  <h1 class="fs-3 fw-fw-semibold pb-2 text-capitalize text-shadow-lg">Kunden anzeigen</h1>
  <div class="row">

  <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
          <?php if (!empty($customer['avatar'])): ?>
            <img src="<?=base_url(esc($customer['avatar'])) ?>" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
              <?php else : ?>
                <img src="https://mighty.tools/mockmind-api/content/human/123.jpg" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
              <?php endif; ?>
              <?php $name = $customer['firstname'] . ' ' . $customer['lastname']; ?>
                <h5 class="my-3"><?= $name ?> </h5>
                <p class="text-muted mb-1"><?= ucfirst(esc($customer['type'])) ?></p>
                <p class="text-muted mb-4">Vienna, CA</p>
                <div class="d-flex justify-content-center mb-2">
            </div>
            <a href="<?= base_url('customer/edit/' . $customer['id']) ?>" class="btn btn-outline-primary mt-3">Edit Profile</a>
          </div>
        </div>
      </div>

    <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $name ?> </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= esc($customer['email'] )?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= esc($customer['phone'] ) ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= esc($customer['phone'] ) ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">Hermann-Bahr-Straße 1, Vienna</p>
              </div>
            </div>
          </div>
        </div> 
      </div>

    </div>

  </div>
  <?= $this->endSection() ?>
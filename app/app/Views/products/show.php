  <?= $this->extend('layouts/app') ?>

  <?= $this->section('content') ?>

  <div class="container mt-5 bg-white">

    <h1 class="fs-3 fw-fw-semibold py-2 text-capitalize text-shadow-lg">Produkt ansehen</h1>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="item-imagee">
          <?php if (!empty($product['image'])): ?>
            <img src="<?= base_url(esc($product['image'])) ?>" alt="image"
              class="img-fluid" style="height: 500px;">
          <?php else : ?>
            <img src="https://mighty.tools/mockmind-api/content/human/123.jpg" alt="image"
              class="img-fluid">
          <?php endif; ?>
        </div>
      </div>
      <div class="col-md-6 d-flex flex-column align-items-start justify-content-center ">
        <div class="">
          <h2 class="display-4"><?= $product['name']; ?></h2>
          <p class="h4">€<?= $product['price']; ?></p>
          <p><?= $product['description']; ?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
  <div class="row py-5 bg-white">
    <h3 class="mb-3 pe-4">Related Products</h3>
    <?php foreach ($relatedProducts as $related): ?>
      <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
        <a href="/product/show/<?= $related->id ?>" class="text-decoration-none">
          <div class="card mb-4">
            <img src="<?= base_url(esc($related->image)) ?>"
              class="card-img-top" alt="<?= esc($related->name) ?>"
              style="height: 250px;" />
            <div class="card-body">
              <div class="d-flex justify-content-between mb-3">
                <h5 class="mb-0"><?= esc($related->name) ?></h5>
                <h5 class="text-dark mb-0">€<?= esc($related->price) ?></h5>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <p class="text-muted mb-0">Verfügbar: <span class="fw-bold"><?= esc($related->stock) ?? 0 ?></span></p>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
  </div>

  </div>
  <style>
    .card {
      transition: transform 0.3s ease;
    }

    .card:hover {
      opacity: 0.7;
    }
  </style>
  <?= $this->endSection() ?>
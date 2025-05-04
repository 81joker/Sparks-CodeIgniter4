<div class="card bg-white shadow rounded-2 my-2 position-relative">
    <div class="card-body">
        <h5 class="card-title">Neueste Produkte</h5>
        <ul class="list-group list-group-flush">
            <?php foreach ($latestProducts as $product): ?>
                <a href="<?php echo base_url('/product/show/' . $product['id']) ?>" class="list-group-item list-group-item-action d-flex align-items-center">

                    <?php if (! empty($product['image'])): ?>
                        <?php
                        $status = $product['status'];
                        $borderClass = ($status == 'active') ? 'border-primary' : 'border-secondary';
                        ?>
                        <img src="<?= base_url(esc($product['image'])) ?>" class="img-thumbnail border border-2 imag-avatar <?= $borderClass ?>"
                            style="width: 3rem;
                                        height: 3rem;
                                        object-fit: cover;" />
                    <?php else : ?>
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" class="img-thumbnail">
                    <?php endif; ?>

                    <div class="ps-4">
                        <span class="fw-semibold d-flex"><?= $product['name'] ?></span>
                        <span class="text-muted"><?= esc(substr($product['description'], 0, 20)) ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </ul>
        <!-- Spinner -->
        <div id="loadingSpinner6" class="spinner-border  position-absolute  start-50 top-50" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <!--/ Spinner -->
    </div>
</div>
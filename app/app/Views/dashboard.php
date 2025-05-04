<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container">
    <h1 class="fs-3 fw-semibold">Dashboard</h1>

    <div class="row pt-2">
        <div class="col-md-3 mb-4 position-relative">
            <div class="card bg-white shadow rounded-2 d-flex align-items-center justify-content-center text-center">
                <div class="card-body">
                    <h6 class="card-title">Aktive Kunden</h6>
                    <h3 class="card-text"><?= $activeCustomers ?></h3>
                </div>
                <!-- Spinner -->
                <div id="loadingSpinner" class="spinner-border  position-absolute " role="status">
                      <span class="visually-hidden">Loading...</span>
                </div>
                <!--/ Spinner -->
            </div>

        </div>
        <div class="col-md-3 mb-4 position-relative">
            <div class="card bg-white shadow rounded-2 d-flex align-items-center justify-content-center text-center">
                <div class="card-body">
                    <h6 class="card-title">Neueste Produkte</h6>
                    <h3 class="card-text"><?= $activeProducts; ?></h3>
                </div>
                <!-- Spinner -->
                <div id="loadingSpinner1" class="spinner-border  position-absolute " role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <!--/ Spinner -->
            </div>
        </div>
        <div class="col-md-3 mb-4 position-relative">
            <div class="card bg-white shadow rounded-2 d-flex align-items-center justify-content-center text-center">
                <div class="card-body">
                    <h6 class="card-title">Total Paid Order</h6>
                    <h3 class="card-text"><?= $totalPaidOrders; ?></h3>
                </div>
                <!-- Spinner -->
                <div id="loadingSpinner2" class="spinner-border  position-absolute " role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <!--/ Spinner -->
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-white shadow rounded-2 d-flex align-items-center justify-content-center text-center">
                <div class="card-body">
                    <h6 class="card-title">Total Income</h6>
                    <h3 class="card-text"><?= $totalIncome; ?></h3>
                </div>
                <!-- Spinner -->
                <div id="loadingSpinner3" class="spinner-border  position-absolute " role="status">
                   <span class="visually-hidden">Loading...</span>
                </div>
                <!--/ Spinner -->
            </div>
        </div>

        <!-- Latest Orders -->
        <div class="col-md-8 mb-2 pe-md-0 position-relative">
            <div class="card bg-white shadow rounded-2 h-auto">
                <div class="card-body font-14">
                    <h5 class="card-title">Letzte Bestellungen</h5>
                    <div class="table-responsive">
                    <table class="table overflow-hidden">
                        <thead>
                            <tr>
                                <th scope="col">#Order</th>
                                <th scope="col">Product</th>
                                <th scope="col"></th>
                                <th scope="col">Price</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Delivery date</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php foreach ($ordersWithDetails as $index => $order): ?>
                                <?php
                                helper('date');
                                ?>
                                <tr>
                                    <th scope="row">
                                        <a href="<?php echo base_url('/order/show/' . $order['id']) ?>" class="link-body-emphasis text-decoration-none d-flex align-items-center link-opacity-50-hover">
                                            <?= $order['id'] ?>
                                        </a>
                                    </th>
                                    <td colspan="2">
                                        <a href="<?php echo base_url('/product/show/' . $order['customer_id']) ?>" class="link-body-emphasis text-decoration-none d-flex align-items-center link-opacity-50-hover">
                                            <?php if (! empty($order['image'])): ?>
                                                <img src="<?= base_url(esc($order['image'])) ?>" class="img-thumbnail border border-2"
                                                    style="
                                        width: 3rem;
                                        height: 3rem;
                                        object-fit: cover;" />
                                            <?php else : ?>
                                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" class="img-thumbnail">
                                            <?php endif; ?>

                                            <div class="ps-4">
                                                <span class="fw-semibold d-flex"><?= $order['product_name'] ?></span>
                                                <span class="fw-bold font-12">Quantity:</span> <?= esc($order['quantity'] ?? 'N/A') ?><br>
                                            </div>
                                        </a>
                                    </td>
                                    <td>€<?= $order['price'] ?></td>
                                    <td>
                                        <a href="<?php echo base_url('/customer/show/' . $order['customer_id']) ?>" class="link-body-emphasis text-decoration-none link-opacity-50-hover">
                                            <?= $order['firstname'] . ' ' . $order['lastname'] ?>
                                        </a>
                                    </td>
                                    <td><?= format_created_at($order['updated_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </div>
                <!-- Spinner -->        
                <div id="loadingSpinner4" class="spinner-border  position-absolute top-25  start-50" role="status" style="top: 10%;">
                     <span class="visually-hidden">Loading...</span>
                </div>
            <!--/ Spinner -->
            </div>
        </div>


        <div class="col-md-4 mb-2 poistion-relative">

            <!-- Latest Users -->
            <div class="card bg-white shadow rounded-2  mb-2">
                <div class="card-body">
                    <h5 class="card-title">Neueste Benutzer</h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($latestUsers as $user): ?>
                            <?php
                            $name = $user['firstname'] . ' ' . $user['lastname'];
                            $activaeUser = \App\Enums\UserStatus::Active->value;
                            ?>
                            <a href="<?php echo base_url('/user/show/' . $user['id']) ?>" 
                            class="list-group-item list-group-item-action d-flex align-items-center">
                                <div class="position-relative">
                                    <?php if ($user['avatar']): ?>

                                        <img src="<?= base_url(esc($user['avatar'])) ?>"
                                            alt="<?= $user['firstname']; ?>" class="rounded-circle imag-avatar-dashboard">
                                    <?php else: ?>
                                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="<?= $name ?>" class="imag-avatar-dashboard">
                                    <?php endif; ?>
                                    <?php if ($user['status'] == 'active' && $activaeUser): ?>
                                        <span class="position-absolute  start-100 translate-middle p-1 bg-success border border-light rounded-circle" style="top: 10%;">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    <?php else: ?>
                                        <span class="position-absolute  start-100 translate-middle p-1 bg-secondary border border-light rounded-circle" style="top: 10%;">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="ps-3">
                                    <span class="fw-semibold d-flex"><?= $name ?></span>
                                    <span class="text-muted font-14"><?= $user['email'] ?></span>
                                </div>
                                <span class="text-muted font-12 ms-auto pt-3"><?php echo $user['role'] ?></span>
                            </a>
                        <?php endforeach; ?>

                    </ul>
                </div>
                <!-- Spinner -->
                <div id="loadingSpinner5" class="spinner-border  position-absolute  start-50 top-50" role="status">
                   <span class="visually-hidden">Loading...</span>
                </div>
                <!--/ Spinner -->
            </div>

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
        </div>
        
    </div>
    <!-- Latest products -->
</div>

<script>

</script>
<?= $this->endSection() ?>
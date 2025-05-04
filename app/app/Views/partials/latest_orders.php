<!-- <div class="col-md-8 mb-2 pe-md-0 position-relative"> -->
    <div class="card bg-white shadow rounded-2 h-auto">
        <div class="card-body font-14">
            <h5 class="card-title">Letzte Bestellungen</h5>
            <div class="table-responsive">
                <table class="table overflow-hidden table-hover">
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
                                <td colspan="2" class="">
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
<!-- </div> -->
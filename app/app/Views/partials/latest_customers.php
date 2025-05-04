<div class="card bg-white shadow rounded-2 my-2 overflow-hidden">
    <div class="card-body">
        <h5 class="card-title">Neueste Kunden</h5>
        <ul class="list-group list-group-flush">
            <?php foreach ($latestCustomers as $customer): ?>
                <?php
                $name = $customer['firstname'] . ' ' . $customer['lastname'];
                $activaeCustomer = \App\Enums\CustomerStatus::Active->value;
                ?>
                <a href="<?php echo base_url('/customer/show/' . $customer['id']) ?>"
                    class="list-group-item list-group-item-action d-flex align-items-center">
                    <div class="position-relative">
                        <?php if ($customer['avatar']): ?>

                            <img src="<?= base_url(esc($customer['avatar'])) ?>"
                                alt="<?= $customer['firstname']; ?>" class="rounded-circle imag-avatar-dashboard">
                        <?php else: ?>
                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="<?= $name ?>" class="imag-avatar-dashboard">
                        <?php endif; ?>
                        <?php if ($customer['status'] == 'active' && $activaeCustomer): ?>
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
                        <span class="text-muted font-14"><?= $customer['email'] ?></span>
                    </div>
                    <span class="text-muted font-12 ms-auto pt-3"><?php echo $customer['type'] ?></span>
                </a>
            <?php endforeach; ?>

        </ul>
    </div>
    <!-- Spinner -->
    <div id="loadingSpinner77" class="spinner-border  position-absolute  start-50 top-50 d-none d-md-block" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <!--/ Spinner -->
</div>
<div class="card bg-white shadow rounded-2 mb-2 overflow-hidden">
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
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


        <div class="col-md-8 mb-2 pe-md-0 position-relative">
        <!-- Latest Orders -->
        <?= view('partials/latest_orders') ?>
        <!--/ Latest Orders -->
        <!-- Latest Customers -->
        <?= view('partials/latest_customers') ?>
        <!--/ Latest Customers -->
        </div>

        <div class="col-md-4 mb-2 poistion-relative">
            <!--Chart Js -->
            <?= view('partials/chart_order') ?>
            <!--/Chart Js -->

            <!-- Latest Users -->
            <?= view('partials/latest_users') ?>
            <!--/ Latest Users -->

            <!-- Latest Products -->
            <?= view('partials/latest_products') ?>
            <!-- Latest products -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>
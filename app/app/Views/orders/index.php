use App\Enums\OrderStatus;
<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between py-2">
        <h1 class="fs-3 fw-fw-semibold pb-2 text-capitalize text-shadow-lg">Bestellungen</h1>
    </div>
    <div class="table-responsive bg-white p-3 rounded-2">
        <table class="table caption-top align-middle table-hover">

            <div class="row d-flex justify-content-between pb-3">
                <div class="col-md-3">
                    <div>order Manager <?= count($orders['orders']) ?></div>

                </div>
                <div class="col-md-3 position-relative">
                    <form id="searchForm" action="/orders" method="GET">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control z-1"
                                placeholder="Search by name or email..."
                                value="<?= esc($orders['search'] ?? '') ?>"
                                id="searchInput">
                            <input type="hidden" name="sort_field" value="<?= esc($orders['sortField'] ?? '') ?>">
                            <input type="hidden" name="sort_direction" value="<?= esc($orders['sortDirection'] ?? '') ?>">
                            <button type="submit" class="input-group-text btn btn-primary">Search</button>
                        </div>
                        <!-- ST Spinner -->
                        <div id="loadingSpinner" class="spinner-border text-primary d-none  position-absolute top-50 ms-3 z-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <!-- En Spinner -->
                    </form>
                </div>
            </div>

            <thead class="table-light">
                <tr class="text-center">
                    <th>#ID</th>
                    <th>Customer</th>
                    <?php 
                    $sortField = $orders['sortField'];
                    $sortDirection = $orders['sortDirection'];
                    ?>
                    <th><?= sortable_column('Status', 'status', $sortField, $sortDirection, $search ?? '') ?></th>
                    <th><?= sortable_column('Total Price', 'total_amount', $sortField, $sortDirection, $search ?? '') ?></th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders['orders'])): ?>
                    <?php foreach ($orders['orders'] as $order): ?>
                        <?php
                        $name = $order['firstname'] . ' ' . $order['lastname'];
                        $badge = getOrderStatusBadge($order['order_status']);
                        ?>
                        <tr class="text-center">
                            <td><?= esc($order['order_id']) ?></td>
                            <td><?= esc($name) ?></td>
                            <td>
                                <span class="<?= $badge['class'] ?>">
                                    <?= esc($order['order_status']) ?>
                                </span>
                            </td>
                            <td><?= esc(format_currency_custom($order['total_amount'])) ?> </td>
                            <td><?= esc(format_created_at($order['created_at'])) ?></td>
                            <td>
                                <a href="/order/show/<?= esc($order['order_id']) ?>" class="rounded-circle border  icon-eye">
                                    <i class="bi bi-eye "></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Keine Benutzer gefunden.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?= $orders['pager']->links() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
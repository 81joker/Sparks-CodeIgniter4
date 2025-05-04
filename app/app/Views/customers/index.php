<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between py-2">
        <h1 class="fs-3 fw-fw-semibold pb-2 text-capitalize text-shadow-lg">Kunden</h1>
        <a href="/customer/create" class="btn btn-primary mb-2">Add New Customer</a>
    </div>

    <div class="table-responsive bg-white p-3 rounded-2">
        <table class="table caption-top align-middle table-hover">


            <div class="row d-flex justify-content-between pb-3">
                <div class="col-md-3">
                    <div>Customer Manager <?= count($customers['customers']) ?></div>

                </div>
                <div class="col-md-3 position-relative">
                    <form id="searchForm" action="/customers" method="GET">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control z-1"
                                placeholder="Search by name or email..."
                                value="<?= esc($customers['search'] ?? '') ?>"
                                id="searchInput">
                            <input type="hidden" name="sort_field" value="<?= esc($customers['sortField'] ?? '') ?>">
                            <input type="hidden" name="sort_direction" value="<?= esc($customers['sortDirection'] ?? '') ?>">
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
                    <th>Avatar</th>
                    <?php 
                    $sortField = $customers['sortField'];
                    $sortDirection = $customers['sortDirection'];
                    ?>
                    <th><?= sortable_column('Name', 'name', $sortField, $sortDirection, $search ?? '') ?></th>
                    <th><?= sortable_column('Eamil', 'email', $sortField, $sortDirection, $search ?? '') ?></th>
                    <th>Type</th>
                    <th>Last Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customers['customers'])): ?>
                <?php foreach ($customers['customers'] as $customer): ?>
                    <tr class="text-center">
                        <td><?= esc($customer['customer_id']) ?></td>
                        <?php
                        $status = $customer['status'];
                        $borderClass = ($status == 'active') ? 'border-primary' : 'border-secondary';
                        ?>
                        <?php if (!empty($customer['avatar'])): ?>
                            <td class="w-25 h-25">
                                <a href="<?= base_url('customer/show/' . $customer['customer_id']) ?>">
                                    <img src="<?= base_url(esc($customer['avatar'])) ?>" class="img-thumbnail rounded-circle imag-avatar border border-3 <?= $borderClass ?>" alt="<?= esc($customer['firstname']) ?>">
                                </a>
                            </td>
                        <?php else : ?>
                            <td>
                             <a href="<?= base_url('customer/show/' . $customer['customer_id']) ?>">
                                  <img src="https://mighty.tools/mockmind-api/content/human/123.jpg" class="img-thumbnail rounded-circle imag-avatar border border-3 <?= $borderClass ?>" alt="<?= esc($customer['firstname']) ?>">
                              </a>
                            </td>
                        <?php endif; ?>
                        <td><?= esc($customer['name']);?></td>
                      
                        <td><?= esc($customer['email']) ?></td>
                        <td><?= ucfirst(esc($customer['type'])) ?></td>
                        <td><?= esc(format_created_at($customer['updated_at'])) ?></td>
                        <td>
                            <div class="dropdown dropstart">
                                <i class="bi bi-three-dots-vertical" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= base_url('customer/edit/' . $customer['customer_id']) ?>">edit</a></li>
                                    <li>
                                        <hr class="dropdown-divider"><a class="dropdown-item" href="<?= base_url('customer/delete/' . $customer['customer_id']) ?>" onclick="return confirm('Möchten Sie die Benutzer wirklich löschen?')">Delete</a>
                                    </li>
                                </ul>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Keine Customer gefunden.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?= $customers['pager']->links() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-between py-2">
        <h1 class="fs-3 fw-fw-semibold pb-2 text-capitalize text-shadow-lg">Produkt verwaltung</h1>

        <a href="/product/create" class="btn btn-primary mb-2">Neues Produkt hinzufügen</a>
    </div>

    <div class="table-responsive bg-white p-3 rounded-2">
        <table class="table caption-top align-middle table-hover">


            <div class="row d-flex justify-content-between pb-3">
                <div class="col-md-3">
                    <div>Product Manager Count <?= count($products) ?></div>

                </div>
                <div class="col-md-3 position-relative">
                    <form id="searchForm" action="/products" method="GET">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control z-1"
                                placeholder="Search by name or email..."
                                value="<?= esc($products['search'] ?? '') ?>"
                                id="searchInput">
                            <input type="hidden" name="sort_field" value="<?= esc($products['sortField'] ?? '') ?>">
                            <input type="hidden" name="sort_direction" value="<?= esc($products['sortDirection'] ?? '') ?>">
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
                    <th>Image</th>
                    <th><?= sortable_column('Name', 'name', $sortField, $sortDirection, $search ?? '') ?></th>
                    <th><?= sortable_column('Price', 'price', $sortField, $sortDirection, $search ?? '') ?></th>
                    <th>Last Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr class="text-center">
                        <td><?= esc($product['id']) ?></td>
                        <?php
                        $status = $product['id'];
                         $borderClass = ($status == 'active') ? 'border-primary' : 'border-secondary';
                        ?>
                        <?php if (!empty($product['image'])): ?>
                            <td class="w-25 h-25">
                                <a href="<?= base_url('product/show/' . $product['id']) ?>">
                                    <img src="<?= base_url(esc($product['image'])) ?>" class="img-thumbnail  imag-avatar border border-3 <?= $borderClass ?>" alt="<?= esc($product['name']) ?>">
                                </a>
                            </td>
                        <?php else : ?>
                            <td>
                             <a href="<?= base_url('product/show/' . $product['id']) ?>">
                                  <img src="https://mighty.tools/mockmind-api/content/human/123.jpg" class="img-thumbnail  imag-avatar border border-3 <?= $borderClass ?>" style="width: 100px;" alt="<?= esc($product['name']) ?>">
                              </a>
                            </td>
                        <?php endif; ?>
                        <td><?= esc($product['name']);?></td>
                      
                        <td><?= esc($product['price']) ?></td>
                        <td><?= esc($product['updated_at']) ?></td>
                        <td>
                            <div class="dropdown dropstart">
                                <i class="bi bi-three-dots-vertical" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= base_url('product/edit/' . $product['id']) ?>">edit</a></li>
                                    <li>
                                        <hr class="dropdown-divider"><a class="dropdown-item" href="<?= base_url('product/delete/' . $product['id']) ?>">Delete</a>
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
            <?= $pager->links(); ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
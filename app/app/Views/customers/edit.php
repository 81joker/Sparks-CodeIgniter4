<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="fs-3 fw-semibold">
        <h1 class="fs-3 fw-fw-semibold pb-2 text-capitalize text-shadow-lg">Kundenbearbeitung</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4 p-md-5">
                        <form method="post" action="/customers/update/<?= $customer['id'] ?>" enctype="multipart/form-data">
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                            <div class="row my-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="firstname" value="<?= $customer['firstname'] ?>" placeholder="Vorname" aria-label="Vorname">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="lastname" value="<?= $customer['lastname'] ?>" placeholder="Nachname" aria-label="Nachname">
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col">
                                    <input type="email" class="form-control" name="email" value="<?= $customer['email'] ?>" placeholder="Email" aria-label="Email">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="phone" value="<?= $customer['phone'] ?>" placeholder="Telefonnummer" aria-label="Telefonnummer">
                                </div>
                            </div>


                            <div class="row my-4">
                                <div class="col">
                                    <input type="file" name="avatar" class="form-control"  accept="image/*" placeholder="Avatar" aria-label="Avatar">  
                                    <?php if (!empty($customer['avatar'])): ?>
                                        <div class="mt-2">
                                            <img src="<?= base_url($customer['avatar']) ?>" alt="Avatar" width="100">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col">
                                    <select id="inputState" class="form-select" name="type">
                                        <option value="" disabled <?= old('type', $customer['type']) ? '' : 'selected'; ?>>Choose...</option>
                                        <option value="parent" <?= (old('type', $customer['type']) === 'parent') ? 'selected' : ''; ?>>Parent</option>
                                        <option value="child" <?= (old('type', $customer['type']) === 'child') ? 'selected' : ''; ?>>Child</option>
                                    </select>
                                </div>
                            </div>


                            <div class="mb-3 d-flex">
                                <div class="form-check">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        <?= ($customer['status'] === 'active') ? 'Active' : 'Inactive'; ?>
                                        <input class="form-check-input" type="checkbox" name="status" value="active" id="flexCheckChecked" <?= ($customer['status'] === 'active') ? 'checked' : '' ?>>
                                    </label>
                                </div>
                            </div>

                            <button type="submit px-4" class="btn btn-primary px-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<?= $this->endSection() ?>
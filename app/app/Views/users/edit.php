<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="fs-3 fw-semibold">
        <h1 class="fs-3 fw-fw-semibold pb-2 text-capitalize text-shadow-lg">Benutzer Bearbeiten</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4 p-md-5">
                        <form method="post" action="/users/update/<?= $user['id'] ?>" enctype="multipart/form-data">
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">


                            <div class="row my-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="firstname" value="<?= $user['firstname'] ?>" placeholder="Vorname" aria-label="Vorname">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="lastname" value="<?= $user['lastname'] ?>" placeholder="Nachname" aria-label="Nachname">
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col">
                                    <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" placeholder="Email" aria-label="Email">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="phone" value="<?= $user['phone'] ?>" placeholder="Telefonnummer" aria-label="Telefonnummer">
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
                                    <select id="inputState" class="form-select" name="role">
                                        <option value="" disabled <?= old('role', $user['role']) ? '' : 'selected'; ?>>Choose...</option>
                                        <option value="admin" <?= (old('role', $user['role']) === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                        <option value="instructor" <?= (old('role', $user['role']) === 'instructor') ? 'selected' : ''; ?>>Instructor</option>
                                    </select>
                                </div>
                            </div>


                            <div class="mb-3 d-flex">
                                <div class="form-check">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        <?= ($user['status'] === 'active') ? 'Active' : 'Inactive'; ?>
                                        <input class="form-check-input" type="checkbox" name="status" value="active" id="flexCheckChecked" <?= ($user['status'] === 'active') ? 'checked' : '' ?>>
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
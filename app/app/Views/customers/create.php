<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="fs-3 fw-semibold">Neuen Kunden erstellen</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4 p-md-5">
                    <form method="post" action="/customers/store" enctype="multipart/form-data">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">


                        <div class="row my-3">
                            <div class="col">
                                <input type="text" class="form-control" name="firstname" value="<?= old('firstname') ?>" placeholder="Vorname" aria-label="Vorname">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="lastname" value="<?= old('lastname') ?>" placeholder="Nachname" aria-label="Nachname">
                            </div>
                        </div>
                    
                        <div class="row my-4">
                            <div class="col">
                                <input type="email" class="form-control" name="email" value="<?= old('email') ?>" placeholder="Email" aria-label="Email">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="phone" value="<?= old('phone') ?>" placeholder="Telefonnummer" aria-label="Telefonnummer">
                            </div>
                        </div>


                        <div class="row my-4">
                            <div class="col">
                                <input type="file" name="avatar" class="form-control <?= session('errors.avatar') ? 'is-invalid' : '' ?>">
                                <?php if (session('errors.avatar')): ?>
                                    <div class="invalid-feedback">
                                        <?= session('errors.avatar') ?>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="col">
                                <select id="inputState" class="form-select" name="type">
                                    <option value="" disabled <?= old('type') ? '' : 'selected'; ?>>Choose...</option>
                                    <option value="parent" <?= (old('type') === 'parent') ? 'selected' : ''; ?>>Parent</option>
                                    <option value="chaild" <?= (old('type') === 'chaild') ? 'selected' : ''; ?>>Child</option>
                                </select>
                            </div>
                        </div>


                        <div class="mb-3 d-flex">
                            <div class="form-check">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Chooese your Status
                                    <input class="form-check-input" type="checkbox" name="status" value="active" id="flexCheckChecked" checked>
                                </label>
                            </div>
                        </div>
                        <button type="submit px-4" class="btn btn-primary px-4">Speichern</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
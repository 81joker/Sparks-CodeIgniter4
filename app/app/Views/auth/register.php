<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<!-- <div class="container"> -->
    <div class="row">
        <div class="col-10 m-auto col-md-6 offset-md-3">
            <div class="text-center mb-2">
                <img src="<?= base_url('assets/images/register.png') ?>" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </div>
            <div class="card rounded-3 shadow-sm mb-4">
                <div class="card-body p-4 p-md-5">
                    <h2 class="fw-bold fs-3 fw-semibold">Willkommen! Registrieren </h2>

                    <form method="post" action="/register" enctype="multipart/form-data">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                        <div class="row">

                            <div class="col-12 col-md-6">
                                <input type="text"
                                    class="form-control <?= (isset($validation) && $validation->hasError('firstname')) ? 'is-invalid' : '' ?>"
                                    name="firstname"
                                    value="<?= old('firstname') ?>"
                                    placeholder="Vorname"
                                    aria-label="Vorname">
                                <?php if (isset($validation) && $validation->hasError('firstname')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('firstname') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text"
                                    class="form-control <?= (isset($validation) && $validation->hasError('lastname')) ? 'is-invalid' : '' ?>"
                                    name="lastname"
                                    value="<?= old('lastname') ?>"
                                    placeholder="Nachname"
                                    aria-label="Nachname">

                                <?php if (isset($validation) && $validation->hasError('lastname')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('lastname') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <input type="email"
                                    class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>"
                                    name="email"
                                    value="<?= old('email') ?>"
                                    placeholder="E-mail"
                                    aria-label="E-mail">

                                <?php if (isset($validation) && $validation->hasError('email')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-12 col-md-6 pb-md-0 pb-3">
                                <input type="text"
                                    class="form-control <?= (isset($validation) && $validation->hasError('phone')) ? 'is-invalid' : '' ?>"
                                    name="phone"
                                    value="<?= old('phone') ?>"
                                    placeholder="Telefonnummer"
                                    aria-label="Telefonnummer">

                                <?php if (isset($validation) && $validation->hasError('phone')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('phone') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <input type="password"
                                    class="form-control <?= (isset($validation) && $validation->hasError('password')) ? 'is-invalid' : '' ?>"
                                    name="password"
                                    value="<?= old('password') ?>"
                                    placeholder="Passwort"
                                    aria-label="Passwort">

                                <?php if (isset($validation) && $validation->hasError('password')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="password"
                                    class="form-control <?= (isset($validation) && $validation->hasError('password_confirm')) ? 'is-invalid' : '' ?>"
                                    name="password_confirm"
                                    value="<?= old('password_confirm') ?>"
                                    placeholder="Passwort bestätigen"
                                    aria-label="Passwort bestätigen">

                                <?php if (isset($validation) && $validation->hasError('password_confirm')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password_confirm') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="row my-md-0 my-3">
                                <div class="col col-md-6">
                                    <input type="file" name="avatar" class="form-control mb-md-0 mb-3 <?= (isset($validation) && $validation->hasError('avatar')) ? 'is-invalid' : '' ?>">
                                    <?php if (isset($validation) && $validation->hasError('avatar')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('avatar') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select id="inputState" class="form-select" name="role">
                                        <option value="" disabled <?= old('role') ? '' : 'selected'; ?>>Choose...</option>
                                        <option value="admin" <?= (old('role') === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                        <option value="instructor" <?= (old('role') === 'instructor') ? 'selected' : ''; ?>>Instructor</option>
                                        <option value="parent" <?= (old('role') === 'parent') ? 'selected' : ''; ?>>Parent</option>
                                        <option value="chaild" <?= (old('role') === 'chaild') ? 'selected' : ''; ?>>Child</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit px-4" class="btn btn-primary px-4 mt-3 w-md-25">Speichern</button>
                    </form>

                    <div class="text-center mt-3">
                        Sie haben kein Konto? <a href="/login">Hier anmelden</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
<?= $this->endSection() ?>
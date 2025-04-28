<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container">
    <!-- <h1 class="fs-3 fw-semibold">Anmelden</h1> -->
    <?= view('partials/alerts') ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('validation_errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('validation_errors') as $field => $errors): ?>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-10 m-auto col-md-6 offset-md-3">
            <div class="text-center mb-2">
                <img src="<?= base_url('assets/images/login.png') ?>" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </div>
            <div class="card rounded-3 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h2 class="fw-bold fs-3 fw-semibold">Willkommen zurück! Anmelden </h2>

                    <form action="<?= route_to('login') ?>" method="post">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                        <div class="my-4">
                            <label for="required" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control  <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>" id="required" aria-describedby="emailHelp" value="<?= old('email') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('email')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="my-4">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control  <?= (isset($validation) && $validation->hasError('password')) ? 'is-invalid' : '' ?>" id="exampleInputPassword1" value="<?= old('password') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('password')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Submit</button>



                    </form>
                    <div class="mt-3">
                        <a href="<?= route_to('forgot') ?>">Passwort vergessen?</a>
                    </div>
                    <div class="mt-3">
                        <a href="<?= route_to('register') ?>">Noch kein Konto? Hier registrieren</a>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <?= $this->endSection() ?>
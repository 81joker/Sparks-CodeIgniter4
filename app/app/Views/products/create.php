<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="fs-3 fw-fw-semibold pb-2 text-capitalize text-shadow-lg">Neue Produkterstellung</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4 p-md-5">
                    <form method="post" action="/products/store" enctype="multipart/form-data">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">


                        <div class="row my-3">
                            <div class="col">
                                <input type="text" class="form-control" name="name" value="<?= old('name') ?>" placeholder="Name" aria-label="Name">
                            </div>
                            <div class="col">
                                <input type="number" min="0" class="form-control" name="price" value="<?= old('price') ?>" placeholder="Peice" aria-label="Peice">
                            </div>
                        </div>
                    
                        <div class="row my-4">
                            <div class="col">
                            <textarea name="description" class="form-control" rows="3" placeholder="Description" aria-label="Description"><?= old('description') ?></textarea>
                            </div>
                            
                        </div>


                        <div class="row my-4">
                            <div class="col">
                                <input type="file" name="image" class="form-control <?= session('errors.image') ? 'is-invalid' : '' ?>">
                                <?php if (session('errors.image')): ?>
                                    <div class="invalid-feedback">
                                        <?= session('errors.image') ?>
                                    </div>
                                <?php endif ?>
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
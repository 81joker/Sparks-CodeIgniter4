<div class="container">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-message">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>


    
    
    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger" >
            <ul class="mb-0">
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>
</div>
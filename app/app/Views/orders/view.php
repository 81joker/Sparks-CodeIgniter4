<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
Order Details
<div class="container my-5">
        <h2 class="text-center mb-4">Bestelldetails</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Produkt</th>
                    <th>Stückzahl</th>
                    <th>Einzelpreis</th>
                    <th>Gesamtpreis</th>
                </tr>
            </thead>
            <tbody>
            <?php $total = 0; ?>
            <?php if (! empty($orderDetails)): ?>
            <?php foreach ($orderDetails as $order): ?>
                <tr>

                    <td><?= esc($order['product_name']) ?></td>
                    <td><?= $order['quantity'] ?></td>
                    <td><?= $order['price'] ?> EUR</td>
                    <td><?= $order['price'] * $order['quantity'] ?> EUR</td>
                </tr>
                <?php $total += $order['price'] * $order['quantity']; ?>
            <?php endforeach; ?>
                <?php else: ?>
                <p>No details found for this order.</p>
            <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="table-primary">
                    <td colspan="3" class="text-center"><strong>Gesamtbetrag</strong></td>
                    <td><strong><?= $total ?> EUR</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex justify-content-between">
            <a href="<?= site_url('orders') ?>" class="btn btn-secondary">Zurück zu Bestellungen</a>
            <button class="btn btn-success" onclick="window.print()">Rechnung drucken</button>
        </div>
</div>
<?= $this->endSection() ?>
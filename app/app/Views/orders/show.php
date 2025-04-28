<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<?php
$name = $customerDetails['firstname'] . ' ' . $customerDetails['lastname'];
?>
<div class="container my-5">
  <section class="gradient-custom">
    <div class="row d-flex justify-content-center align-items-center">

      <div class="d-flex justify-content-between mb-2">
        <a href="<?= site_url('orders') ?>" class="btn btn-secondary btn-md">Zurück zu Bestellungen</a>
        <button class="btn btn-secondary btn-md" onclick="window.print()">Rechnung drucken</button>
      </div>

      <div class="col-lg-10 col-xl-12">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 d-flex justify-content-between align-items-center text-light bg-body rounded">

            <div>
              Kundendetails :
              <hr class="mt-0 mb-1">
              <h6 class="mb-0 font-12 text-white">Kunde : <a href="/customer/show/<?= esc($customerDetails['customer_id']) ?>" class="text-light"><?= esc($name) ?></a></h6>
              <h6 class="mb-0 font-12 text-white">Email : <?= esc($customerDetails['email']) ?></h6>
              <h6 class="mb-0 font-12 text-white">Kundentyp : <?= esc($customerDetails['customer_type'] ?? 'N/A') ?></h6>
              <h6 class="mb-0 font-12 text-white">Registriert am : <?= esc($customerDetails['created_at'] ?? 'N/A') ?></h6>
              <h6 class="mb-0 font-12 text-white">Letzte Bestellung : <?= esc($customerDetails['updated_at'] ?? 'N/A') ?></h6>
              <h6 class="mb-0 font-12 text-white">Telefon : <?= esc($customerDetails['phone'] ?? 'N/A') ?></h6>
            </div>

            <?php if (!empty($customerDetails['avatar'])): ?>
              <img src="<?= base_url(esc($customerDetails['avatar'])) ?>" class="img-fluid img-thumbnail  border border-3" alt="<?= esc($customerDetails['firstname']) ?>"
              style="width: 6rem; height: 6rem; object-fit: cover;">
              
            <?php else: ?>
              <img src="https://mighty.tools/mockmind-api/content/human/123.jpg" class="img-thumbnail w-md-25 border border-3" style="width: 100px;" alt="<?= esc($customerDetails['firstname']) ?>">
            <?php endif; ?>

          </div>
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0 text-black font-monospace">Quittung: #<?= esc($customerDetails['order_number']) ?></p>
              <?php
              $badge = getOrderStatusBadge($customerDetails['order_status']);
              ?>
              <span class="<?= esc($badge['class']) ?>">
                <?= esc($badge['label']) ?>
              </span>
            </div>

            <?php $total = 0; ?>
            <?php if (!empty($orderDetails)): ?>
              <?php foreach ($orderDetails as $order): ?>
                <a href="/product/show/<?= esc($order['product_id']) ?>" class="text-decoration-none">
                <div class="card shadow-0 border mb-4 wrap-order-product">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2">
                        <img src="<?= base_url(esc($order['image'])) ?>" class="img-fluid imag-avatar" alt="<?= esc($order['product_name']) ?>">
                      </div>
                      <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0"><?= esc($order['product_name']) ?></p>
                      </div>
                      <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small">Qty: <?= esc($order['quantity']) ?></p>
                      </div>
                      <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small"><?= esc(format_currency_custom($order['price'])) ?></p>
                      </div>
                    </div>
                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                  </div>
                </div>
                <?php $total += $order['price'] * $order['quantity']; ?>
                </a>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-muted"><strong><?= esc($name) ?></strong>, Keine Details zu dieser Bestellung gefunden</p>
            <?php endif; ?>

            <div class="pt-2 w-md-25">
              <h6 class="fw-bold mb-0 text-decoration-underline">Order Details:</h6>
            </div>

            <?php
            $discount = ($total >= 100) ? 10 : 0;
            $finalTotal = $total - $discount;
            $formattedDate = format_created_at($customerDetails['created_at']);
            ?>

            <div class="d-md-flex justify-content-between pt-2 pb-sm-2">
              <div class="text-muted mb-0">Order Status:
                <form method="POST" action="/order/updateStatus/<?= esc($customerDetails['order_id']) ?>">
                  <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                  <div class="d-flex justify-content-between">
                    <select class="form-select me-0" name="order_status">
                      <option selected><?= esc($customerDetails['order_status']) ?></option>
                      <option value="processing">In Bearbeitung</option>
                      <option value="shipped">Versendet</option>
                      <option value="cancelled">Storniert</option>
                      <option value="completed">Abgeschlossen</option>
                      <option value="paid">Bezahlt</option>
                      <option value="unpaid">Unbezahlt</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Aktualisieren</button>
                  </div>
                </form>
              </div>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Zwischensumme</span><?= format_currency_custom($total) ?></p>
            </div>
            <div class="d-md-flex justify-content-between pt-2">
              <p class="text-muted mb-0">Rechnungsnummer : <?= esc($customerDetails['order_number']) ?></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Rabatt</span><?= format_currency_custom($discount) ?></p>
            </div>
            <div class="d-md-flex justify-content-between">
              <p class="text-muted mb-0">Rechnungsdatum : <?= esc($formattedDate) ?></p>
            </div>
            <div class="d-md-flex justify-content-between mb-5">
              <p class="text-muted mb-0">Bezahlter Betrag : <?= esc($customerDetails['total_amount']) ?></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Versandkosten</span> kostenlos</p>
            </div>

          </div>
          <div class="card-footer border-0 px-4 py-4 bg-body rounded">
            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Gesamtbetrag: <span class=" mb-0 ms-2"><?= format_currency_custom($finalTotal) ?></span></h5>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?= $this->endSection() ?>
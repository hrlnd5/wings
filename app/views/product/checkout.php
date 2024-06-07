<!-- Product List Container -->
<div class="container mt-5 p-4 border rounded bg-white shadow-sm">
    <div class="progress-bar-container">
        <a href="<?= APP_URL; ?>">
            <div class="circle"></div>
        </a>
        <div class="circle active"></div>
        <div class="circle"></div>
    </div>
    <div class="product-list">
        <form action="<?= APP_URL; ?>/transaction/checkoutConfirmation" method="post">
            <?php
            $subtotal = 0;
            foreach ($data['products'] as $product) :
                $price = $product['discount'] > 0 ? $product['price'] * ((100 - $product['discount']) / 100) : $product['price'];
                $subtotal += $price;
            ?>
                <div class="card mb-3">
                    <div class="card-body d-flex align-items-center">
                        <div class="product-image-l mr-3"></div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1"><?= $product['product_name'] ?></h6>
                            <div class="d-flex align-items-center">
                                <input type="number" min="1" class="form-control mr-2" name="quantities[]" value="1" style="width: 60px;">
                                <input type="hidden" name="prices[]" value="<?= $price; ?>">
                                <input type="hidden" name="units[]" value="<?= $product['unit']; ?>">
                                <input type="hidden" name="product_codes[]" value="<?= $product['product_code']; ?>">
                                <input type="hidden" name="currencies[]" value="<?= $product['currency']; ?>">
                                <input type="hidden" name="subtotals[]" value="<?= $price; ?>">
                                <span><?= $product['unit'] ?></span>
                            </div>
                            <?php if ($product['discount'] > 0) : ?>
                                <p class="mb-0">Subtotal : <span>Rp <?= number_format((float)$product['price'] * ((100 - $product['discount']) / 100), 2, ',', '.'); ?></span></p>
                            <?php else : ?>
                                <p class="mb-0">Subtotal : <span>Rp <?= number_format((float)$product['price'], 2, ',', '.'); ?></span></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="total-box">
                <input type="hidden" name="total" value="<?= $subtotal; ?>">
                <h6>TOTAL : Rp <?= number_format((float)$subtotal, 2, ',', '.'); ?></h6>
            </div>
            <button class="btn btn-confirm mt-3" type="submit">CONFIRM</button>
        </form>
    </div>
</div>
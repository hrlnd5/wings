<!-- Product List Container -->
<div class="container mt-5 p-4 border rounded bg-white shadow-sm">
    <div class="progress-bar-container">
        <div class="circle active"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="product-list">
        <?php foreach ($data['products'] as $product) : ?>
            <div class="d-flex justify-content-between mb-3">
                <?php if ($product['discount'] > 0) : ?>
                    <a href="<?= APP_URL; ?>/product/detail/<?= $product['product_code']; ?>" class="d-flex align-items-center">
                        <div class="product-image mr-3 px-2"></div>
                        <div class="flex-grow-1">
                            <div class="font-weight-bold"><?= $product['product_name']; ?></div>
                            <div>
                                <span class="old-price">Rp <?= number_format((float)$product['price'], 2, ',', '.'); ?></span>
                                <span class="new-price">Rp <?= number_format((float)$product['price'] * ((100 - $product['discount']) / 100), 2, ',', '.'); ?></span>
                            </div>
                        </div>
                    </a>
                <?php else : ?>
                    <a href="<?= APP_URL; ?>/product/detail/<?= $product['product_code']; ?>" class="d-flex align-items-center">
                        <div class="product-image mr-3"></div>
                        <div class="flex-grow-1">
                            <div class="font-weight-bold"><?= $product['product_name']; ?></div>
                            <div class="text-dark">Rp <?= number_format((float)$product['price'], 2, ',', '.'); ?></div>
                        </div>
                    </a>
                <?php endif; ?>
                <?php if (!isset($_SESSION['tempOrder' . $_SESSION['user']['user']]) || empty($_SESSION['tempOrder' . $_SESSION['user']['user']])) : ?>
                    <a class="btn btn-buy" data-code="<?= $product['product_code']; ?>">BUY</a>
                    <a class="btn btn-remove d-none" data-code="<?= $product['product_code']; ?>">REMOVE</a>
                <?php else : ?>
                    <?php if (!in_array($product['product_code'], $_SESSION['tempOrder' . $_SESSION['user']['user']])) : ?>
                        <a class="btn btn-buy" data-code="<?= $product['product_code']; ?>">BUY</a>
                        <a class="btn btn-remove d-none" data-code="<?= $product['product_code']; ?>">REMOVE</a>
                    <?php else : ?>
                        <a class="btn btn-buy d-none" data-code="<?= $product['product_code']; ?>">BUY</a>
                        <a class="btn btn-remove" data-code="<?= $product['product_code']; ?>">REMOVE</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="<?= APP_URL; ?>/product/checkout" class="btn btn-custom btn-block">CHECKOUT</a>
</div>
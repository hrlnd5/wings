<div class="container mt-5">
    <div class="card product-card">
        <h5 class="card-title">PRODUCT DETAIL</h5>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="product-image-xl mb-3"></div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h6 class="product-title text-left"><?= $data['product']['product_name']; ?></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php if ($data['product']['discount'] > 0) : ?>
                                <p class="text-left"><span class="old-price">Rp <?= number_format((float)$data['product']['price'], 2, ',', '.'); ?></span></p>
                                <p class="new-price text-left">Rp <?= number_format((float)$data['product']['price'] * ((100 - $data['product']['discount']) / 100), 2, ',', '.'); ?></p>
                            <?php else : ?>
                                <p class="text-left">Rp <?= number_format((float)$data['product']['price'], 2, ',', '.'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row text-left">
                        <span class="col-md-5">Dimension</span>
                        <span class="col-md-7"> : <?= $data['product']['dimension']; ?></span>
                    </div>
                    <div class="row text-left">
                        <span class="col-md-5">Price Unit</span>
                        <span class="col-md-7"> : <?= $data['product']['unit']; ?></span>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <?php if (!in_array($data['product']['product_code'], $_SESSION['tempOrder' . $_SESSION['user']['user']])) : ?>
                                <a class="btn btn-buy btn-block" data-code="<?= $data['product']['product_code']; ?>">BUY</a>
                                <a class="btn btn-remove d-none btn-block" data-code="<?= $data['product']['product_code']; ?>">REMOVE</a>
                            <?php else : ?>
                                <a class="btn btn-buy d-none btn-block" data-code="<?= $data['product']['product_code']; ?>">BUY</a>
                                <a class="btn btn-remove btn-block" data-code="<?= $data['product']['product_code']; ?>">REMOVE</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
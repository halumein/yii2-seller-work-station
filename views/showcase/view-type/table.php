<?php


\halumein\sws\assets\ShowcaseAsset::register($this);

?>

<div class="col-md-12">
    <div class="row">
        <div class="tariff-grid-left-column col-md-4" style="width: 20%">
            <table class="table">
                <thead>
                <tr>
                    <th>услуга</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product) { ?>
                    <tr data-role="service-row">
                        <td style="height: 76px;">
                                <span title="<?= $product['name']; ?>">
                                    <?= mb_substr($product['name'], 0, 41); ?>
                                </span>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
        <div class="tariff-grid-right-column">
            <table class="table table-bordered table-hover service-prices-table" data-role="tariff-grid">
                <thead>
                <tr>
                    <?php foreach ($categories as $category) { ?>
                        <?php if ($category['show']) {?>
                        <th class="tariff-column text-center"><?= $category['name']; ?></th>
                        <?php } ?>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $productId => $product) { ?>
                    <tr data-role="category-row">
                        <?php foreach ($categories as $categoryId => $category) {
                         if ($category['show']) { ?>
                            <td align="center">
                                <div class="tariff-block" data-role="tariff-block">
                                    <?php if (isset($tariffs[$categoryId][$productId]['price'])) { ?>
                                <span class="price" data-role="service-price">
                                    <i class="glyphicon glyphicon-ruble"
                                       style="font-size: small"></i>
                                    <b><?= $tariffs[$categoryId][$productId]['price'] ?></b></span>
                                    <br>

                                <span class="discount"
                                      data-role="service-discount"><b><?= $tariffs[$categoryId][$productId]['maxDiscount'] ?></b></span>
                                    <br>
                                    <?php } ?>
                                    <?php if (isset($tariffs[$categoryId][$productId]['id'])) { ?>
                                <span class="add-to-cart" data-role="add-element-btn"
                                      data-model="<?= $tariffs[$categoryId][$productId]['modelName'] ?>"
                                      data-product-id="<?= $tariffs[$categoryId][$productId]['id'] ?>"
                                      data-url="<?= \yii\helpers\Url::toRoute(['/tools/cart-create']); ?>"
                                ><i class="glyphicon glyphicon-shopping-cart" style="font-size: large"></i></span>
                                    <?php } ?>
                                </div>
                            </td>
                        <?php }
                        } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
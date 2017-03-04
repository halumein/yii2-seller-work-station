
<div class="showcase-item product-item hidden"
     style="<?= $showImages ? "min-height: 200px;height: 205px;" : "min-height: 100px; height: 105px;" ?>"
     data-product-id="<?= $productId ?>"
     data-role="showcase-product"
     data-model="<?=$product['modelName'] ?>"
     data-parent-id="<?=$categoryId?>"
     data-url="<?=\yii\helpers\Url::toRoute([$addElementToCartUrl]); 
     ?>"
     data-product-name="<?= $product['name'] ?>"
     <?php
        if (isset($product['code']) && $product['code'] != '') {
            echo 'data-product-code="'.$product['code'].'"';
        }
     ?>
     >
    <div class="showcase-item-title text-center">
        <?= $product['name'] ?>
    </div>
    <?php if ($showImages) { ?>
        <div class="showcase-item-image text-center" data-role="showcase-item-image-containter" data-img-src=<?= $product['image'] ?> >
            <img src="<?= $spinnerImgSrc ?>" alt="<?= $product['name'] ?>">
        </div>
    <?php } ?>
    <div class="showcase-item-price">
        <div class="row">
            <div class="col-sm-6">
                <input class="showcase-item-amount-input text-right" type="number" name="" value="1" data-role="showcase-item-amount-input">
            </div>
            <div class="col-sm-6 text-right" data-role="showcase-item-price" data-default-price="<?= $product['price'] ?>">
                <?= $product['price'] ?> руб.
            </div>
        </div>
        <!-- <input class="showcase-item-price-input text-right" type="text" name="" value="<?php // $product['price'] ?>" data-base-price="<?php // $product['price'] ?>"> -->
    </div>
</div>
<?= pistol88\cart\widgets\BuyButton::widget([
    'model' => $product['model'],
    'text' => '<i class="glyphicon glyphicon-shopping-cart"></i>',
    'htmlTag' => 'div',
    'cssClass' => 'btn btn-default hidden'
]) ?>

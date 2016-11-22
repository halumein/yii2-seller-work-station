<div class="row">
    <div class="col-sm-12">
        <input class="form-control" type="text" name="name" value="" placeholder="быстрый поиск товара">
    </div>
</div>

<div class="row">
    <div class="col-sm-12 breadcrumbs">
        <ul data-role="breadcrumbs">
            <li class="showcase-breadcrumbs" data-role="breadcrumbs-button" data-target="main">Главная</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="showcase-main current-active" data-category-case-id="main">
            <?php foreach ($categories as $categoryId => $category) { ?>
                <?php if (is_null($category['parentCategoryId'])) { ?>
                <div class="showcase-item category-item" data-role="showcase-category-button" data-category-id="<?= $categoryId ?>">
                    <div class="showcase-item-title text-center">
                        <?= $category['name'] ?>
                    </div>
                    <div class="showcase-item-image text-center">
                        <?php // echo $category['image'] ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
        </div>

        <?php foreach ($categories as $categoryId => $category) { ?>
                <div class="showcase-category hidden" data-role="showcase-category" data-category-case-id="<?= $categoryId ?>">
                    <?php foreach ($category['childCategories'] as $key => $childCategory) { ?>
                        <div class="showcase-item category-item" data-role="showcase-category-button" data-category-id="<?= $childCategory ?>" >
                            <div class="showcase-item-title text-center">
                                <?= $categories[$childCategory]['name'] ?>
                            </div>
                            <div class="showcase-item-image text-center">
                                <img src="<?=  $categories[$childCategory]['image'] ?>" alt="<?= $category['name'] ?>">
                            </div>
                        </div>
                    <?php } ?>

                    <?php foreach ($category['products'] as $productId => $product) { ?>
                        <div class="showcase-item product-item" data-product-id="<?= $productId ?>" data-role="showcase-product" >
                            <div class="showcase-item-title text-center">
                                <?= $product['name'] ?>
                            </div>
                            <div class="showcase-item-image text-center">
                                <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                            </div>
                            <div class="showcase-item-price">
                                <div class="row">
                                    <div class="col-sm-6">

                                    </div>
                                    <div class="col-sm-6 text-right">
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
                    <?php } ?>

                </div>
        <?php } ?>



    </div>
</div>

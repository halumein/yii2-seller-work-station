<?php
?>
<?php if(\Yii::$app->getModule('sws')->debug) { ?>
    <div class="row">
        <div class="col-sm-12">
            <ul data-role="breadcrumbs-debug">
                <li class="showcase-breadcrumbs" data-role="show-all" data-target="search">Все товары</li>
            </ul>
        </div>
    </div>
<?php } ?>

<div class="row">
    <div class="col-sm-12">
        <input class="form-control" type="text" name="name" value="" placeholder="быстрый поиск товара" data-role="quick-search" autocomplete="off">
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
                <div class="showcase-item category-item"
                     style="<?= $showImages ? "min-height: 200px;height: 205px;" : "min-height: 100px; height: 105px;" ?>"
                     data-role="showcase-category-button"
                     data-category-id="<?= $categoryId ?>"
                     data-parent-id="main" >

                    <div class="showcase-item-title text-center">
                        <?= $category['name'] ?>
                    </div>
                    <?php if ($showImages) { ?>
                        <div class="showcase-item-image text-center" data-role="showcase-item-image-containter" data-img-src=<?= $categories[$categoryId]['image'] ?>>
                            <img src="<?= $spinnerImgSrc ?>" alt="<?= $category['name'] ?>">
                        </div>
                    <?php } ?>
                </div>
                <?php } ?>
            <?php } ?>

            <?php foreach ($categories as $categoryId => $category) { ?>
                <?php foreach ($category['childCategories'] as $key => $childCategory) { ?>
                    <div class="showcase-item category-item hidden"
                         style="<?= $showImages ? "min-height: 200px;height: 205px;" : "min-height: 100px; height: 105px;" ?>"
                         data-role="showcase-category-button"
                         data-category-id="<?= $childCategory ?>"
                         data-parent-id=<?=$categoryId?> >
                        <div class="showcase-item-title text-center">
                            <?= $categories[$childCategory]['name'] ?>
                        </div>
                        <?php if ($showImages) { ?>
                            <div class="showcase-item-image text-center" data-role="showcase-item-image-containter" data-img-src=<?= $categories[$childCategory]['image'] ?>>
                                <img src="<?= $spinnerImgSrc ?>" alt="<?= $categories[$childCategory]['name'] ?>">
                                <!-- <img src="<?php // echo  $categories[$childCategory]['image'] ?>" alt="<?= $category['name'] ?>"> -->
                            </div>
                        <?php } ?>

                    </div>
                <?php } ?>

                <?php foreach ($category['products'] as $productId => $product) {

                    echo $this->render($productItemView,[
                        'categoryId' => $categoryId,
                        'productId' => $productId,
                        'product' => $product,
                        'showImages' => $showImages,
                        'spinnerImgSrc' => $spinnerImgSrc,
                        'addElementToCartUrl' => $addElementToCartUrl,
                    ]);
                } ?>
            <?php } ?>
        </div>
    </div>
</div>

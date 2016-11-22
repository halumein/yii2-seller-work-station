<?php
    use pistol88\cart\widgets\ElementsList;
    use pistol88\cart\widgets\CartInformer;

    $this->title = 'Витрина';
 ?>


<div class="showcase-order">
    <div class="">
        <div class="row">
            <div class="col-sm-12 col-md-9 showcase">
                <?php echo \halumein\sws\widgets\Showcase::widget([
                    'categories' => $categories,
                    // 'products' => $products,
                    // 'modifications' => $modifications,
                ]); ?>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="row">
                    <div class="col-sm-12">
                        <?=ElementsList::widget(['columns' => '3', 'showCountArrows' => false, 'type' => ElementsList::TYPE_FULL]);?>
                    </div>
                    <div class="col-sm-12 promocode">
                        <?php if(yii::$app->has('promocode')) { ?>
                                <?=\pistol88\promocode\widgets\Enter::widget();?>
                        <?php } ?>
                    </div>
                    <div class="col-sm-12 cart-summary">
                        Всего: <?= CartInformer::widget(['htmlTag' => 'span', 'text' => '{c} на {p}']); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <?= \pistol88\order\widgets\OrderFormLight::widget([
                            'useAjax' => true,
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $this->title = 'Витрина';

    $topWidgets = \Yii::$app->getModule('sws')->topBlockWidgets;
    $rightWidgets = \Yii::$app->getModule('sws')->rightBlockWidgets;
    $bottomWidgets = \Yii::$app->getModule('sws')->bottomBlockWidgets;

 ?>


<div class="showcase-order">

    <div class="row">
        <div class="col-sm-12 top-widgets">
            <?php if ($topWidgets) { ?>
                <?php foreach ($topWidgets as $key => $widget) {
                    echo "<div ". (isset($widget['wrapperCssClass']) ? 'class="'.$widget['wrapperCssClass'].'"' : '') .">";
                        echo $widget['widget']::widget($widget['settings']);
                    echo "</div>";
                } ?>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-9 showcase">
            <?php echo \halumein\sws\widgets\Showcase::widget([
                'categories' => $categories,
                'products' => $products,
                // 'modifications' => $modifications,
            ]); ?>
        </div>
        <div class="col-sm-12 col-md-3 right-widgets">
                <?php if ($rightWidgets) { ?>
                    <?php foreach ($rightWidgets as $key => $widget) {
                        echo "<div ". (isset($widget['wrapperCssClass']) ? 'class="'.$widget['wrapperCssClass'].'"' : '') .">";
                            echo $widget['widget']::widget($widget['settings']);
                        echo "</div>";
                    } ?>
                <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 bottom-widgets">
            <?php if ($bottomWidgets) { ?>
                <?php foreach ($bottomWidgets as $key => $widget) {
                    echo "<div ". (isset($widget['wrapperCssClass']) ? 'class="'.$widget['wrapperCssClass'].'"' : '') .">";
                        echo $widget['widget']::widget($widget['settings']);
                    echo "</div>";
                } ?>
            <?php } ?>
        </div>
    </div>

</div>

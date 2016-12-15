<?php
$this->title = 'АРМ';

$topWidgets = $module->topBlockWidgets;
$rightWidgets = $module->rightBlockWidgets;
$bottomWidgets = $module->bottomBlockWidgets;

\halumein\sws\assets\ArmAsset::register($this);

 ?>


<div class="showcase-order content">

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
        <div class="col-sm-12 col-md-8 showcase">
            <?php echo \halumein\sws\widgets\Showcase::widget([
                'categories' => $categories,
                'products' => $products,
                // 'modifications' => $modifications,
            ]); ?>
        </div>
        <div class="col-sm-12 col-md-4 right-widgets">
            <div class="slide-block">
                <div class="slide-content">
                    <?php if ($rightWidgets) { ?>
                        <?php foreach ($rightWidgets as $key => $widget) {
                            echo "<div ". (isset($widget['wrapperCssClass']) ? 'class="'.$widget['wrapperCssClass'].'"' : '') .">";
                                echo $widget['widget']::widget($widget['settings']);
                            echo "</div>";
                        } ?>
                    <?php } ?>
                </div>
            </div>

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

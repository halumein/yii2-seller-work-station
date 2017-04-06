<?php
$this->title = 'АРМ';

$topWidgets = $module->topBlockWidgets;
$rightWidgets = $module->rightBlockWidgets;
$bottomWidgets = $module->bottomBlockWidgets;

\halumein\sws\assets\ArmAsset::register($this);

?>


<div class="showcase-order content">
    <div class="row">
        <div class="col-md-2 types">
            <div class="order-type">
                <form action="" method="get">
                    <select class="form-control" name="service-view-type" onchange="$(this).parent('form').submit();">
                        <option value="table">Таблицей</option>
                        <option value="sws" <?php if ($type == 'sws') {
                            echo ' selected="selected"';
                        } ?>>Сеткой
                        </option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-8 showcase">
            <?php if ($topWidgets) { ?>
                <?php foreach ($topWidgets as $key => $widget) {
                    echo "<div " . (isset($widget['wrapperCssClass']) ? 'class="' . $widget['wrapperCssClass'] . '"' : '') . ">";
                    echo $widget['widget']::widget($widget['settings']);
                    echo "</div>";
                } ?>
            <?php } ?>
            <?php if ($type == 'sws') {
                echo $this->render('view-type/sws', [
                    'categories' => $categories,
                    'products' => $products,
                    'productItemView' => $productItemView,
                    'addElementToCartUrl' => $addElementToCartUrl,
                    // 'modifications' => $modifications,
                ]);
            } else {
                echo $this->render('view-type/table', [
                    'products' => $products,
                    'tariffs' => $tariffs,
                    'categories' => $categories,
                    'addElementToCartUrl' => $addElementToCartUrl,
                ]);
            }
            ?>
        </div>
        <div class="col-sm-12 col-md-4 right-widgets">
            <div class="slide-block">
                <div class="slide-content">
                    <?php if ($rightWidgets) { ?>
                        <?php foreach ($rightWidgets as $key => $widget) {
                    echo "<div " . (isset($widget['wrapperCssClass']) ? 'class="' . $widget['wrapperCssClass'] . '"' : '') . ">";
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
            echo "<div " . (isset($widget['wrapperCssClass']) ? 'class="' . $widget['wrapperCssClass'] . '"' : '') . ">";
            echo $widget['widget']::widget($widget['settings']);
            echo "</div>";
            } ?>
            <?php } ?>
        </div>
    </div>

</div>

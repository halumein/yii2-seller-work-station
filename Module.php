<?php

namespace halumein\sws;

class Module extends \yii\base\Module
{
    public $categoryModel;

    public $debug = false;
    public $rightBlockWidgets = null;
    public $bottomBlockWidgets = null;
    public $topBlockWidgets = null;
    public $showImages = true;

    public function init()
    {
        parent::init();
    }

}

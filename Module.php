<?php

namespace halumein\sws;

class Module extends \yii\base\Module
{
    public $categoryModel;
    
    public $rightBlockWidgets = null;
    public $bottomBlockWidgets = null;
    public $topBlockWidgets = null;

    public function init()
    {
        parent::init();
    }

}

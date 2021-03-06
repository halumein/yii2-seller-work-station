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
    public $barcodeScannerEnable = false; // для инпута штрихкод-сканер
    public $adminRoles = ['superadmin', 'administrator'];
    public $productItemView = '_productItem';
    public $addElementToCartUrl = '/cart/element/create';

    public function init()
    {
        parent::init();
    }

}

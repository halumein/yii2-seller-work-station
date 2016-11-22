<?php
namespace halumein\sws\widgets;

use yii\helpers\Html;
use yii\helpers\Url;
use yii;

class Showcase extends \yii\base\Widget
{
    public $categories = null;
    public $products = null;
    public $modifications = null;

    public function init()
    {
        \halumein\sws\assets\ShowcaseAsset::register($this->getView());

        return parent::init();
    }

    public function run()
    {
        $categories = $this->categories;
        $products = $this->products;
        $modifications -> $this->modifications;

        return $this->render('showCase', [
            'categories' => $categories,
            'products' => $products,
            'modification' => $modifications
        ]);
    }
}

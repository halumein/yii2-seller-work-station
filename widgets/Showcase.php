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
    public $spinnerImgSrc = null;
    public $showImages = true;

    public function init()
    {
        $assets = \halumein\sws\assets\ShowcaseAsset::register($this->getView());

        if ($this->spinnerImgSrc === null) {
            $this->spinnerImgSrc = $assets->baseUrl . '/img/image-preloader.gif';
        }

        return parent::init();
    }

    public function run()
    {
        $this->showImages = Yii::$app->getModule('sws')->showImages;
        
        $categories = $this->categories;
        $products = $this->products;
        $modifications = $this->modifications;

        return $this->render('showCase', [
            'categories' => $categories,
            'products' => $products,
            'modification' => $modifications,
            'spinnerImgSrc' => $this->spinnerImgSrc,
            'showImages' => $this->showImages,
        ]);
    }
}

<?php
namespace halumein\sws\assets;

use yii\web\AssetBundle;

class ArmAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'js/arm.js',
    ];

    public $css = [
        'css/arm.css',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();
    }
}

<?php
namespace halumein\sws;

use yii\base\BootstrapInterface;
use yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if(!$app->has('sws')) {
            $app->set('sws', ['class' => 'halumein\sws\Sws']);
        }
    }
}

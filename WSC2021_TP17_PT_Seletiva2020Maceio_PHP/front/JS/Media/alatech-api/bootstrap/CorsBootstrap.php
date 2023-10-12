<?php

namespace app\bootstrap;

use yii\base\Application;
use yii\base\BootstrapInterface;

class CorsBootstrap implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $app->response->headers->set('Access-Control-Allow-Origin', '*');
        $app->response->headers->set('Access-Control-Allow-Methods', '*');
        $app->response->headers->set('Access-Control-Allow-Headers', '*');
    }
}

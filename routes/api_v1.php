<?php

/** @var Laravel\Lumen\Application $app */

$app->router->group([
    'namespace' => 'App\Http\Controllers\Api\V1',
    'prefix' => 'api/v1',
], function ($router)  {
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
});


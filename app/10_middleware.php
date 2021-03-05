<?php

namespace App;


use Brace\Body\BodyMiddleware;
use Brace\Core\AppLoader;
use Brace\Core\Base\ExceptionHandlerMiddleware;
use Brace\Core\Base\JsonReturnFormatter;
use Brace\Core\Base\NotFoundMiddleware;
use Brace\Core\BraceApp;
use Brace\Router\RouterDispatchMiddleware;
use Brace\Router\RouterEvalMiddleware;
use Brace\Session\SessionMiddleware;
use Brace\Session\Storages\FileSessionStorage;


AppLoader::extend(function (BraceApp $app) {

    $app->setPipe([
        new ExceptionHandlerMiddleware(),
        new SessionMiddleware(new FileSessionStorage("/tmp")),
        new RouterEvalMiddleware(),
        new BodyMiddleware(),
        new RouterDispatchMiddleware([
            new JsonReturnFormatter($app)
        ]),
        new NotFoundMiddleware()
    ]);
});

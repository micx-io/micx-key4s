<?php

namespace App;


use Brace\Body\BodyMiddleware;
use Brace\Core\AppLoader;
use Brace\Core\Base\ExceptionHandlerMiddleware;
use Brace\Core\Base\JsonReturnFormatter;
use Brace\Core\Base\NotFoundMiddleware;
use Brace\Core\BraceApp;
use Brace\CORS\CorsMiddleware;
use Brace\Router\RouterDispatchMiddleware;
use Brace\Router\RouterEvalMiddleware;
use Brace\Session\SessionMiddleware;
use Brace\Session\Storages\CookieSessionStorage;
use Brace\Session\Storages\FileSessionStorage;


AppLoader::extend(function (BraceApp $app) {

    $app->setPipe([
        new CorsMiddleware(["*"]),
       // new ExceptionHandlerMiddleware(),
        new SessionMiddleware(new CookieSessionStorage("SECRET_KEY_ABCDEFG_ABCDEDF")),
        new RouterEvalMiddleware(),
        new BodyMiddleware(),
        new RouterDispatchMiddleware([
            new JsonReturnFormatter($app)
        ]),
        new NotFoundMiddleware()
    ]);
});

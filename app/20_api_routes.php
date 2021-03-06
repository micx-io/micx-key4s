<?php
namespace App;



use Brace\Core\AppLoader;
use Brace\Core\BraceApp;
use Lack\OidServer\Base\Ctrl\AuthorizeCtrl;
use Lack\OidServer\Base\Ctrl\SignInCtrl;
use Lack\OidServer\Base\Ctrl\SignOutCtrl;
use Lack\OidServer\Base\Ctrl\TokenCtrl;
use Lack\OidServer\Base\Tpl\HtmlTemplate;

AppLoader::extend(function (BraceApp $app) {


    $app->router->on("GET@/authorize", new AuthorizeCtrl());

    $app->router->on("POST@/oauth/token", new TokenCtrl());

    $app->router->on("GET|POST@/signin", new SignInCtrl(
        new HtmlTemplate(__DIR__ . "/../conf/tpl/signin.tpl.html")
    ));

    $app->router->on("GET@/signout", new SignOutCtrl());

});

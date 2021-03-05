<?php
namespace App;


use Brace\Auth\Basic\AuthBasicMiddleware;
use Brace\Body\BodyMiddleware;
use Brace\Connection\ConnectionInfoModule;
use Brace\Core\AppLoader;
use Brace\Core\Base\ExceptionHandlerMiddleware;
use Brace\Core\Base\JsonReturnFormatter;
use Brace\Core\Base\NotFoundMiddleware;
use Brace\Core\BraceApp;
use Brace\Mod\Request\Zend\BraceRequestLaminasModule;
use Brace\Router\RouterDispatchMiddleware;
use Brace\Router\RouterEvalMiddleware;
use Brace\Router\RouterModule;
use Lack\OidServer\Base\OidApp;
use Micx\Key4s\Key4s;
use Micx\Key4s\Type\T_TenantConfig;
use Micx\Key4s\UserManager\FileBasedClientManager;
use Micx\Key4s\UserManager\FileBasedUserManager;
use Phore\Di\Container\Producer\DiService;
use Phore\Di\Container\Producer\DiValue;
use Phore\VCS\Git\SshGitRepository;
use Phore\VCS\VcsFactory;
use Rudl\GitDb\AccessChecker;
use Rudl\GitDb\AccessCheckerMiddleware;
use Rudl\GitDb\ObjectAccessor;
use Rudl\GitDb\State;
use Rudl\Vault\Lib\Config;
use Rudl\Vault\Lib\KeyVault;


AppLoader::extend(function () {
    $app = new OidApp();
    $app->addModule(new BraceRequestLaminasModule());
    $app->addModule(new RouterModule());

    $app->define("app", new DiValue($app));


    $app->define("resourceOwnerReadManager", new DiService(fn() => new FileBasedUserManager(__DIR__ . "/../conf/resource-owners.yml")));
    $app->define("clientReadManager", new DiService(fn() => new FileBasedClientManager(__DIR__ . "/../conf/clients.yml")));

    $app->define("tenantConfig", new DiService(fn() => phore_file(__DIR__ . "/../conf/tenant-config.yml")->hydrate(T_TenantConfig::class)));
    return $app;
});

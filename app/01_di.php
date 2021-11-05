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
use Brace\Dbg\BraceDbg;
use Brace\Mod\Request\Zend\BraceRequestLaminasModule;
use Brace\Router\RouterDispatchMiddleware;
use Brace\Router\RouterEvalMiddleware;
use Brace\Router\RouterModule;
use Doctrine\CouchDB\CouchDBClient;
use Lack\OidServer\Base\Ctrl\TokenCtrl;
use Lack\OidServer\Base\OidApp;
use Micx\Key4s\Key4s;
use Micx\Key4s\Manager\ClaimManager;
use Micx\Key4s\Manager\JwtManagerFirebase;
use Micx\Key4s\Type\T_TenantConfig;
use Micx\Key4s\UserManager\RedisTokenManager;
use Micx\Key4s\UserManager\ClientManager;
use Micx\Key4s\UserManager\UserManager;
use Phore\Di\Container\Producer\DiService;
use Phore\Di\Container\Producer\DiValue;
use Phore\UniDb\UniDb;
use Phore\UniDb\UniDbConfig;
use Phore\VCS\Git\SshGitRepository;
use Phore\VCS\VcsFactory;
use Rudl\GitDb\AccessChecker;
use Rudl\GitDb\AccessCheckerMiddleware;
use Rudl\GitDb\ObjectAccessor;
use Rudl\GitDb\State;
use Rudl\Vault\Lib\Config;
use Rudl\Vault\Lib\KeyVault;

BraceDbg::SetupEnvironment(true, ["192.168.178.20", "localhost", "localhost:8080"]);


AppLoader::extend(function () {
    $app = new OidApp();
    $app->addModule(new BraceRequestLaminasModule());
    $app->addModule(new RouterModule());

    $app->define("app", new DiValue($app));

    $app->define("uniDb", new DiService(function() {
        return UniDbConfig::get();
    }));

    $app->define("jwtBuilder", new DiService(fn () => new JwtManagerFirebase("abcd", "HS256")));

    $app->define("claimManager", new DiService(fn() => new ClaimManager(
        iss: "http://localhost",token_ttl: 1800
    )));

    $app->define("redis", new DiService(function () {
        $redis = new \Redis();
        $redis->connect("redis");
        return $redis;
    }));

    $app->define("tokenManager", new DiService(fn(\Redis $redis) => new RedisTokenManager($redis)));


    $app->define("userReadManager", new DiService(fn(UniDb $uniDb) => new UserManager($uniDb)));
    $app->define("clientReadManager", new DiService(fn(UniDb $uniDb) => new ClientManager($uniDb)));

    return $app;
});

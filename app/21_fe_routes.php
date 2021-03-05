<?php
namespace App;

use Brace\Auth\Basic\BasicAuthToken;
use Brace\Core\AppLoader;
use Brace\Core\BraceApp;
use Brace\Router\Type\RouteParams;
use Brace\UiKit\Bootstrap\BootstrapUiPage;
use Laminas\Diactoros\Response;
use Phore\VCS\VcsRepository;
use Psr\Http\Message\RequestInterface;
use Rudl\GitDb\ObjectAccessor;
use Rudl\GitDb\State;
use Rudl\LibGitDb\Type\Transport\T_Object;
use Rudl\LibGitDb\Type\Transport\T_ObjectList;
use Rudl\Vault\Lib\Config;
use Rudl\Vault\Lib\Format\MultilineFormat;
use Rudl\Vault\Lib\Format\StringFormat;
use Rudl\Vault\Lib\KeyLoader\CallbackKeyLoader;
use Rudl\Vault\Lib\KeyVault;

AppLoader::extend(function (BraceApp $app) {

});

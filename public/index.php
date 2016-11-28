<?php
require __DIR__ . '/../vendor/autoload.php';

use MyZD\AppMiddleware;
use Zend\Diactoros\Uri;
use Zend\Stratigility\MiddlewarePipe;



$server =  \Zend\Diactoros\Server::createServer(
    new AppMiddleware(),$_SERVER,$_GET,$_POST,$_COOKIE,$_FILES);


$server->listen();
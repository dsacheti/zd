<?php
//use Psr\Http\Message\RequestInterface;//usada para o lado cliente
use Psr\Http\Message\ServerRequestInterface;//usada para o lado servidor-receber por exemplo get e post
use Psr\Http\Message\ResponseInterface;

require __DIR__ . '/vendor/autoload.php';

$server = \Zend\Diactoros\Server::createServer(
    function(ServerRequestInterface $request, ResponseInterface $response){
        $data = $request->getParsedBody();
        $e =  $data['codigo'];
        $f = new \MyZD\Cep\Cep();
        $res = $f->verifica($e);
        $response->getBody()->write($res);
    },
    $_SERVER,$_GET,$_POST,$_COOKIE,$_FILES);

$server->listen();
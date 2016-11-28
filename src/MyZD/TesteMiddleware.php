<?php

namespace MyZD;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Stratigility\MiddlewareInterface;

class TesteMiddleware implements MiddlewareInterface
{
     /**
     * @param Request $request
     * @param Response $response
     * @param null|callable $out
     * @return null|Response
     */
    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        return $response->write("<h3>Entrou na página teste</h3>");
    }
}
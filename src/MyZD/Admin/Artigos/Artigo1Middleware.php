<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 24/11/2016
 * Time: 17:08
 */

namespace MyZD\Admin\Artigos;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Stratigility\MiddlewareInterface;

class Artigo1Middleware implements MiddlewareInterface
{

    /**
     * @param Request $request
     * @param Response $response
     * @param null|callable $out
     * @return null|Response
     */
    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        return $response->write("<h3>Administração do artigo1</h3><p>/admin/artigos/artigo1</p>");
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 24/11/2016
 * Time: 16:48
 */

namespace MyZD;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Stratigility\MiddlewareInterface;

class SegundaMiddleware implements MiddlewareInterface
{

    /**
     * @param Request $request
     * @param Response $response
     * @param null|callable $out
     * @return null|Response
     */
    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        return $response->write("<h3>Entro na outra página</h3><p>/outro</p>");
    }
}
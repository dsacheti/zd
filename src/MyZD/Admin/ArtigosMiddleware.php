<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 24/11/2016
 * Time: 16:53
 */

namespace MyZD\Admin;


use MyZD\Admin\Artigos\Artigo1Middleware;
use MyZD\Admin\Artigos\Artigo2Middleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Stratigility\MiddlewareInterface;
use Zend\Stratigility\MiddlewarePipe;

class ArtigosMiddleware extends MiddlewarePipe
{

    public function __construct()
    {
        parent::__construct();
        $this->pipe('/',function($request,$response,$next){
            if (!in_array($request->getUri()->getPath(),['/',''],true)){
                return $next($request,$response);
            }
            return $response->write("<h3>Mostrando administração de artigos</h3><p>/admin/artigos</p>");
        });
        $this->pipe('/artigo1',new Artigo1Middleware());
        $this->pipe('/artigo2',new Artigo2Middleware());
    }
}
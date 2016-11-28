<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 24/11/2016
 * Time: 16:51
 */

namespace MyZD\Admin;


use Zend\Stratigility\MiddlewareInterface;
use Zend\Stratigility\MiddlewarePipe;

class AdminMiddleware extends MiddlewarePipe
{
    public function __construct()
    {
        parent::__construct();
        $this->pipe('/',function($request,$response,$next){
            if (!in_array($request->getUri()->getPath(),['/',''],true)){
                return $next($request,$response);
            }
            return $response->write("<h3>Mostrando página admin</h3>");
        });
        $this->pipe('/artigos',new ArtigosMiddleware());
    }
}
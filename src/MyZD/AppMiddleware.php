<?php


namespace MyZD;


use MyZD\Admin\AdminMiddleware;
use MyZD\Cep\CepMiddleware;
use Zend\Stratigility\MiddlewarePipe;

class AppMiddleware extends MiddlewarePipe
{
    public function __construct()
    {
        parent::__construct();
        $this->pipe('/',function($request,$response,$next){
            //o true é para comparar estritamente strings - questão de segurança
            //o método getUri de request parece erro, mas ele existe na classe Request
            //o método write de response parece erro, mas ele existe na classe Response
            if (!in_array($request->getUri()->getPath(),['/',''],true)){
                return $next($request,$response);
            }
            return $response->write("Mostrando minha página principal");
        });
        $this->pipe('/teste',new TesteMiddleware());
        $this->pipe('/segunda',new SegundaMiddleware());
        $this->pipe('/admin',new AdminMiddleware());
    }

}
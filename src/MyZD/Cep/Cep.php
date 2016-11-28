<?php


namespace MyZD\Cep;

use Zend\Diactoros\Uri;

class Cep
{
    public function verifica($cep)
    {
        $uri =new Uri('https://viacep.com.br/ws/'.$cep.'/json/');
        $request = (new \Zend\Diactoros\Request())->withUri($uri)->withMethod('GET');
        $guzzle = new \GuzzleHttp\Client();
        $adaptador = new \Http\Adapter\Guzzle6\Client($guzzle);

        $response = $adaptador->sendRequest($request);
        return $response->getBody();
    }
}
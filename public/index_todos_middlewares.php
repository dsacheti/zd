<?php
require __DIR__ . '/../vendor/autoload.php';

use Zend\Diactoros\Uri;
use Zend\Stratigility\MiddlewarePipe;

$app =new MiddlewarePipe();
$admin = new MiddlewarePipe();
$artigos = new MiddlewarePipe();
$adArtigos = new MiddlewarePipe();

$server =  \Zend\Diactoros\Server::createServer($app,$_SERVER,$_GET,$_POST,$_COOKIE,$_FILES);

$app->pipe('/',function($request,$response,$next){
    //o true é para comparar estritamente strings - questão de segurança
    //o método getUri de request parece erro, mas ele existe na classe Request
    //o método write de response parece erro, mas ele existe na classe Response
    if (!in_array($request->getUri()->getPath(),['/',''],true)){
        return $next($request,$response);
    }
    return $response->write("Mostrando minha página principal");
});

$app->pipe('/teste',function($request,$response,$next){
    return $response->write("<h3>Entrou na página teste</h3><p>/teste</p>");
});
$app->pipe('/outro',function($request,$response,$next){
    return $response->write("<h3>Entro na outra página</h3><p>/outro</p>");
});


$admin->pipe('/',function($request,$response,$next){
    if (!in_array($request->getUri()->getPath(),['/',''],true)){
        return $next($request,$response);
    }
    return $response->write("Mostrando minha página administrativa");
});

$admin->pipe('/teste',function($request,$response,$next){
    return $response->write("Entrou na página teste");
});
$admin->pipe('/outro',function($request,$response,$next){
    return $response->write("Entro na outra página");
});


//artigos

$artigos->pipe('/',function($request,$response,$next){
    if (!in_array($request->getUri()->getPath(),['/',''],true)){
        return $next($request,$response);
    }
    return $response->write("<h3>Mostrando a página de artigos</h3><p>/artigos</p>");
});

//-/artigos/artigo1
$artigos->pipe('/artigo1',function($request,$response,$next){
    return $response->write("<h3>Aqui está o artigo 1</h3><p>/artigos/artigo1</p>");
});

//-/artigos/artigo2
$artigos->pipe('/artigo2',function($request,$response,$next){
    return $response->write("<h3>Este é o artigo 2</h3><p>/artigos/artigo2</p>");
});

//admin artigos - /admin/artigos
$adArtigos->pipe('/',function($request,$response,$next) {
    if (!in_array($request->getUri()->getPath(), ['/', ''], true)) {
        return $next($request, $response);
    }
    return $response->write("<h3>Página de administração dos artigos</h3><p>/admin/artigos</p>");
});

//-/admin/artigos/artigo2
$adArtigos->pipe('/artigo2',function($request,$response,$next){
    return $response->write("<h3>Administre o artigo 2</h3><p>/admin/artigos/artigo2</p>");
});

//-/admin/artigos/artigo1
$adArtigos->pipe('/artigo1',function($request,$response,$next){
    return $response->write("<h3>Gerenciamento do artigo1</h3><p>/admin/artigos/artigo1</p>");
});

$app->pipe('/busca',function($request,$response,$next){
    $uri =new Uri('/buscar_cep.html');
    $request = (new \Zend\Diactoros\Request())->withUri($uri)->withMethod('GET');
    $guzzle = new \GuzzleHttp\Client();
    $adaptador = new \Http\Adapter\Guzzle6\Client($guzzle);

    $response = $adaptador->sendRequest($request);
    echo $response->getBody();
});

//apontando os middlewares secundários para o middleware principal que é o app
$app->pipe('/artigos',$artigos);
$app->pipe('/admin',$admin);
$admin->pipe('/artigos',$adArtigos);//-/admin/artigos

$server->listen();
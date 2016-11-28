<?php
require __DIR__ . '/../vendor/autoload.php';

use Zend\Diactoros\Uri;

$par = "29850000";
$uri =new Uri('https://viacep.com.br/ws/'.$par.'/json/');
$request = (new \Zend\Diactoros\Request())->withUri($uri)->withMethod('GET');
$guzzle = new \GuzzleHttp\Client();
$adaptador = new \Http\Adapter\Guzzle6\Client($guzzle);

$response = $adaptador->sendRequest($request);
echo $response->getBody();


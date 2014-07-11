<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/libs/ApiToolKit.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->get('/', function() use ($app){
    $a = ApiToolkit::getHomeUrl();    
    return $a;
});
 
$app->get('/search/{query}', function (Request $request, $query){
    return "search";
});

$app->get('/search/{query}/page{number}', function (Request $request, $query, $number){
    return "search";
});

$app->get('/hello/{name}', function ($name) use ($app) {
    return $app['twig']->render('hello.twig', array(
        'name' => $name,
    ));
});

// código de los controladores
 
$app->run();

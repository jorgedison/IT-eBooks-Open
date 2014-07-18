<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/libs/ApiToolKit.php';
require_once __DIR__.'/protected/exceptions/exceptions.php';
require_once __DIR__.'/protected/endpoints/search.php';
require_once __DIR__.'/protected/endpoints/book.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\DelegatingEngine;
use Symfony\Bridge\Twig\TwigEngine;


$app = new Silex\Application();

$app->error(function (\Exception $e, $code) {
    $error = new exceptions;
    $e = $error->exceptions($code);
    return new Response($e);
});

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'         => __DIR__.'/protected/views',
));

$app->get('/', function() use ($app){
    $a = ApiToolkit::getHomeUrl();    
    return $app['twig']->render('index.twig', array(
        'name' => $a,
    ));
});
 
$app->get('/search/{query}', function (Request $request, $query) use ($app){
    $search = new search;
    $search_r = $search->getSearch($query);
    return $app['twig']->render('search.twig', array(
        'name' => $search_r,
    ));
});

$app->get('/search/{query}/page{number}', function (Request $request, $query, $number){
    return "search";
});

$app->get('/book/{id}', function (Request $request, $id) use ($app){
    $book = new book;
    $book_r = $book->getBook($id);
    return $app['twig']->render('book.twig', array(
        'name' => $book_r,
    ));
});
 
$app->run();

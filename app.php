<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/protected/libs/ApiToolKit.php';
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
    switch ($code) {
        case 404:
            $message = 'No hemos encontrado la página solicitada.';
            break;
        default:
            $message = 'Lo sentimos pero ha sucedido un error grave.';
    }
 
    return new Response($message);
});

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'         => __DIR__.'/protected/views',
));

$app->get('/', function() use ($app){
    $a = ApiToolkit::getHomeUrl();    
    return $a;
});
 
$app->get('/search/{query}', function (Request $request, $query) use ($app){
    $search = new search;
    $search_r = $search->getSearch($query);
    return $search_r;
});

$app->get('/search/{query}/page/{number}', function (Request $request, $query, $number){
    $search = new search;
    $search_p = $search->getSearchPage($query, $number);
    return $search_p;
});

$app->get('/book/{id}', function (Request $request, $id){
    $book = new book;
    $book_r = $book->getBookId($id);
    return $book_r;
});
 

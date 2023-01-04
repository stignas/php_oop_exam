<?php
declare(strict_types=1);

use eas\Container\DiContainer;
use eas\Router\Router;

require_once (__DIR__ . '/vendor/autoload.php');

$request = $_SERVER["REQUEST_URI"];
$route = str_replace('/paskaitos/OOP/PHP_OOP_EXAM', '', $request);
$container = new DiContainer();

try {
    /* @var Router $router */
    $router = $container->get('eas\Router\Router');
    $router->process($route);
} catch (Exception $e) {
   echo $e->getMessage();
}
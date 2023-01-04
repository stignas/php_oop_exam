<?php
declare(strict_types=1);

namespace eas\Router;

use eas\Container\DiContainer;
use eas\Controllers\HomePageController;
use Exception;

class Router
{
    public function __construct(private readonly DiContainer $container)
    {
    }

    /**
     * @throws Exception
     */
    public function process(string $route): void
    {
        /* @var HomePageController $HomePageController
         */
        $HomePageController = $this->container->get('eas\Controllers\HomePageController');

        switch ($route) {
            case '/':
                $HomePageController->index();
                break;
            case '/forma':
                // formos kontroleris
                break;
            case '/rezultatai':
                // rezultatu kontroleris
                break;
            default:
                http_response_code(404);
                $HomePageController->error();
                break;
        }
    }
}
<?php
declare(strict_types=1);

namespace eas\Router;

use eas\Container\DiContainer;
use eas\Controllers\HomePageController;
use eas\Models\InputHandler;
use Exception;

class Router
{
    public function __construct(private readonly DiContainer $container)
    {
    }

    public function process(string $route): void
    {
        /* @var HomePageController $HomePageController
         * @var InputHandler $InputController
         */
        $HomePageController = $this->container->get('eas\Controllers\HomePageController');
        $InputController = $this->container->get('eas\Controllers\InputController');

        switch ($route) {
            case '/':
                $HomePageController->index();
                break;
            case '/submit.php':
                $InputController->process();
                break;
            default:
                http_response_code(404);
                $HomePageController->error();
                break;
        }
    }
}
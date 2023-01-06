<?php
declare(strict_types=1);

namespace eas\Router;

use eas\Container\DiContainer;
use eas\Controllers\HomePageController;
use eas\Controllers\InputController;
use eas\Controllers\ReportController;
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
        /* @var HomePageController $homePageController
         * @var InputController $inputController
         * @var ReportController $reportController
         */
        $homePageController = $this->container->get('eas\Controllers\HomePageController');
        $inputController = $this->container->get('eas\Controllers\InputController');
        $reportController = $this->container->get('eas\Controllers\ReportController');

        switch ($route) {
            case '/':
                $homePageController->index();
                break;
            // Paspaudus 'Skaičiuoti kainą' įvedimo formoje, nukreipiam į reikiamą kontrolerį.
            case '/submit.form':
                $inputController->processInput();
                break;
            case '/report':
                $reportController->createReport();
                break;
            // Paspaudus 'Deklaruoti ir apmokėti" ataskaitoje, nukreipiam į reikiamą kontrolerį.
            case '/pay.money':
                $inputController->pay();
                break;
            default:
                http_response_code(404);
                $homePageController->error();
                break;
        }
    }
}
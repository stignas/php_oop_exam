<?php
declare(strict_types=1);

namespace eas\Controllers;

use eas\Container\DiContainer;
use eas\Handlers\InputHandler;
use Exception;

class InputController
{

    public function __construct(private readonly DiContainer $container)
    {
    }

    public function process(): void
    {
        /* @var InputHandler $inputHandler
         */
        try {
            $inputHandler = $this->container->get('eas\Models\InputHandler');
            $inputHandler->process();

            /*
             * TODO: ReportHandler
             * TODO: FileHandler
             * TODO: require report.tpl
             */

        } catch (Exception $e) {
            $_POST['message'] = $e->getMessage();
            require __DIR__ . '/../../views/index.tpl';
        }
//        echo "<pre>";
//        print_r($_POST);

    }

}
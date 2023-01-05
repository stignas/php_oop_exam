<?php
declare(strict_types=1);

namespace eas\Controllers;

use eas\Container\DiContainer;
use eas\Exceptions\InputExceptions;
use eas\Handlers\FileHandler;
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
            $inputHandler = $this->container->get('eas\Handlers\InputHandler');
            $inputHandler->checkDate();
            $data = $inputHandler->setInputData($_POST);
            $this->container->get('eas\Handlers\FileHandler')->addEntryToFile($data);
            header('Location: ' . $_SERVER['REQUEST_URI'] . '/../report');
        } catch (Exception $e) {
            $message = $e->getMessage() . PHP_EOL;
            require __DIR__ . '/../../views/index.tpl';
        }
    }

    /**
     * @throws Exception
     * @var FileHandler $fileHandler
     */
    public function pay(): void
    {
        $this->container->get('eas\Handlers\InputHandler')->setPaid();
        header('Location: ' . $_SERVER['REQUEST_URI'] . '/../');
    }
}
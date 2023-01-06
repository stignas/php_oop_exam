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

    public function processInput(): void
    {
        /* @var InputHandler $inputHandler
         */
        try {
            $inputHandler = $this->container->get('eas\Handlers\InputHandler');
            $inputHandler->checkDate();
            /* Jeigu įvesta neteisinga data,  toliau vykdomas "catch" blokas.
            Jeigu įvesta teisinga data, duomenys paruošiami ir įrašomi į failą.
            */
            $InputData = $inputHandler->setInputData($_POST);
            $this->container->get('eas\Handlers\FileHandler')->addEntryToFile($InputData);
            /* Nukreipiam į ataskaitą neperduodami jokių duomenų.
               Routeris nukreipa į Report Controller, kuris sugeneruoja ataskaitą iš failo.
            */
            header('Location: ' . $_SERVER['REQUEST_URI'] . '/../report');
        } catch (Exception $e) {
            $message = $e->getMessage() . PHP_EOL;
            // Gautą error message perduodam į index view informuoti vartotoją.
            require __DIR__ . '/../../views/index.tpl';
        }
    }

    /**
     * @throws Exception
     */
    public function pay(): void
    {
        $this->container->get('eas\Handlers\InputHandler')->setPaid();
        require __DIR__ . '/../../views/index.tpl';
    }
}
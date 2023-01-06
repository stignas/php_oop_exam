<?php
declare(strict_types=1);

namespace eas\Controllers;

use eas\Container\DiContainer;
use eas\Handlers\ReportHandler;
use Exception;

class ReportController
{

    public function __construct(private readonly DiContainer $container)
    {
    }

    /**
     * @throws Exception
     */
    public function createReport(): void
    {
        try {
            $payments = $this->container->get('eas\Handlers\ReportHandler')->createPaymentList();
            $total = 0; // Perduodam pradinę sumą į view'ą ir ten paskaičiuojam neapmokėtą bendrą sumą.
            require __DIR__ . '/../../views/report.tpl';
        } catch (Exception $e) {
            // Jei nėra neapmokėtų sąskaitų ar įvyko kokia kita klaida, perduodam žinutę į view'ą klientui.
            $message = $e->getMessage();
            require __DIR__ . '/../../views/report.tpl';
        }
    }
}

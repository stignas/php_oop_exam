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
        $total = 0;
        require __DIR__ . '/../../views/report.tpl';
        }
        catch (Exception $e)
        {
            $message = $e->getMessage();
            require __DIR__ . '/../../views/report.tpl';
        }
    }
}

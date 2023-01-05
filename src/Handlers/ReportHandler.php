<?php
declare(strict_types=1);

namespace eas\Handlers;

use eas\Container\DiContainer;
use Exception;

class ReportHandler
{

    public function __construct(private readonly DiContainer $container)
    {
    }

    /**
     * @throws Exception
     */
    public function createPaymentList(): array
    {
        $data = $this->container->get('eas\Handlers\FileHandler')->getData();
        $paymentsArray = [];
        foreach ($data as $payment) {
            if ($payment['status'] === 'NotPaid') {
                $paymentObj = match ($payment['rate']) {
                    'day' => $this->container->get('eas\Models\DayRatePaymentDeclaration'),
                    'night' => $this->container->get('eas\Models\NightRatePaymentDeclaration'),
                    default => throw new Exception('Failed to create payment. (ReportHandler)')
                };
                $paymentObj->setQuantity((float)$payment['quantity']);
                $paymentObj->setPriceRate((float)$payment['price_rate']);
                $paymentObj->setMonth(date('F', strtotime($payment['month'] . "-01")));
                $paymentObj->setStatus('Neapmokėta');
                $paymentsArray[] = $paymentObj;
            }
        }
        if (count($paymentsArray) < 1) {
            throw new Exception('Neapmokėtų sąskaitų nėra (ReportHandler)');
        }
        return $paymentsArray;
    }
}
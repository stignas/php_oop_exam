<?php
declare(strict_types=1);

namespace eas\Handlers;

use DateTime;
use eas\Container\DiContainer;
use eas\Exceptions\InputExceptions;
use Exception;

class InputHandler
{

    public function __construct(private readonly DiContainer $container)
    {
    }

    /**
     * @throws InputExceptions
     * @throws Exception
     */
    public function checkDate(): bool
    {
        date_default_timezone_set('Europe/Vilnius');

        $currentDateString = date('Y-n-d');
        $inputDateString = date('Y-n-t', strtotime($_POST['month'] . "-01"));
        $currentDateObj = new DateTime($currentDateString);
        $inputDateObj = new DateTime($inputDateString);
        $diff = $currentDateObj->diff($inputDateObj)->days;
        /*
        *  Kai pasirinktas dabartinis arba būsimas mėnuo.
        */
        if ($inputDateObj->format('Y-m') >= $currentDateObj->format('Y-m')) {
            $message = 'Mokėjimas atliekamas per anksti.';
            throw new InputExceptions($message);
        }
        /*
         *  Kai pasirinktas ankstesnis mėnuo.
         */

        if ($inputDateObj->format('Y-m') < $currentDateObj->modify('-1month')->format('Y-m')) {
            $message = sprintf('Jūs vėluojate sumokėti mokesčius %s dienas(-ų).', $diff);
            throw new InputExceptions($message);
        }
        return true;
    }

    public function setInputData(array $inputData): array
    {
        return [
            'quantity' => $inputData['quantity'],
            'price_rate' => $inputData['price_rate'],
            'rate' => $inputData['rate'],
            'status' => $inputData['status'],
            'month' => $inputData['month']
        ];
    }

    /**
     * @throws Exception
     */
    public function setPaid(): void
    {
        $data = $this->container->get('eas\Handlers\FileHandler')->getData();
        $array = [];
        foreach ($data as $payment) {
            $payment['status'] = "Paid";
            $array[] = $payment;
        }
        $this->container->get('eas\Handlers\FileHandler')->updateJsonPaymentStatus($array);
    }
}
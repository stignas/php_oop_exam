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
        /* $InputDateString - sukuriam Date String formatu 'Y-n-t', kuris grąžina paskutinę mėnesio dieną.
           Nuo jos skaičiuojam kiek dienų vėluoja mokėjimas, jeigu įvesti ankstesni mėnesiai.
           strtotime() Per formą gauname tik metus ir dieną, taigi dar pridedam dieną, kad eilutė atitiktų formatą
           kuriant DateTime objektą.
        */
        $inputDateString = date('Y-n-t', strtotime($_POST['month'] . "-01"));
        $currentDateObj = new DateTime($currentDateString);
        $inputDateObj = new DateTime($inputDateString);
        $diff = $currentDateObj->diff($inputDateObj)->days;

        #  Kai pasirinktas dabartinis arba būsimas mėnuo.

        if ($inputDateObj->format('Y-m') >= $currentDateObj->format('Y-m')) {
            $message = 'Mokėjimas atliekamas per anksti.';
            throw new InputExceptions($message);
        }

        # Kai pasirinktas ankstesnis mėnuo.

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
            'month' => $inputData['month'],
        ];
    }

    /**
     * @throws Exception
     * @var FileHandler $fileHandler
     */
    public function setPaid(): void
    {
        $fileHandler = $this->container->get('eas\Handlers\FileHandler');
        $data = $fileHandler->getData();
        $array = [];
        foreach ($data as $payment) {
            $payment['status'] = "Paid";
            $array[] = $payment;
        }
        $fileHandler->updateJsonPaymentStatus($array);
    }
}
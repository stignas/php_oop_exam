<?php
declare(strict_types=1);

namespace eas\Handlers;

use DateTime;
use eas\Exceptions\InputExceptions;
use Exception;

class InputHandler
{
    /**
     * @throws InputExceptions
     * @throws Exception
     */
    public function process(): void
    {
        date_default_timezone_set('Europe/Vilnius');

        $currentDateString = date('Y-n-d');
        $inputDateString = date('Y-n-t', strtotime($_POST['month'] . "-01"));
        $currentDateObj = new DateTime($currentDateString);
        $inputDateObj = new DateTime($inputDateString);

        $_POST['current_date'] = $currentDateObj->format('Y-n-d');
        $_POST['input_date'] = $inputDateObj->format('Y-n-d');
        $_POST['diff'] = $currentDateObj->diff($inputDateObj)->days;

        /*
         *  Kai pasirinktas dabartinis arba būsimas mėnuo.
         */
        if ($inputDateObj->format('Y-n') >= $currentDateObj->format('Y-n')) {
            $message = 'Mokėjimas atliekamas per anksti.';
            throw new InputExceptions($message);
        }
        /*
         *  Kai pasirinktas ankstesnis mėnuo.
         */
        if ($inputDateObj->format('Y-n') < $currentDateObj->modify('-1month')->format('Y-n')) {
            $message = sprintf('Jūs vėluojate sumokėti mokesčius %s dienas(-ų).', $_POST['diff']);
            throw new InputExceptions($message);
        }
    }
}
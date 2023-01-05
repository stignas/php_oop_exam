<?php
declare(strict_types=1);

namespace eas\Exceptions;

use Exception;
use Throwable;

class InputExceptions extends Exception
{

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getMsg(): string
    {
        return $this->message;
    }


}
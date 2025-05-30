<?php

namespace App\Exceptions;

use Exception;

class InvalidCnpjException extends Exception
{
    protected $code = 422;

    public function __construct(string $message = 'A clinic with this CNPJ already exists.')
    {
        parent::__construct($message, $this->code);
    }
}

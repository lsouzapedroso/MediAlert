<?php

namespace App\Exceptions;

use Exception;

class ClinicNameNotUniqueException extends Exception
{
    // Opcional: Personalize o código de status HTTP padrão
    protected $code = 422; // HTTP Unprocessable Entity

    public function __construct(string $message = 'A clinic with this name already exists.')
    {
        parent::__construct($message, $this->code);
    }
}

<?php

namespace Storage\Exceptions;

use Exception;

class InvalidFileException extends Exception {
    public function __construct($file, $code = 0, Exception $previous = null)
    {
        $message = "The file [ $file ] doesn't exist";
        parent::__construct($message, $code, $previous);
    }
}
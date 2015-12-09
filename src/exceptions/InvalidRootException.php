<?php

namespace Storage\Exceptions;

use Exception;

class InvalidRootException extends Exception {
    public function __construct($root,$code = 0,Exception $previous = null) {
        $message = "The path [ $root ] is not a valid folder.";
        parent::__construct($message,$code,$previous);
    }
}
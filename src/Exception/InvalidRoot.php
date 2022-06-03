<?php

namespace Storage\Exception;

use Exception;

class InvalidRoot extends Exception
{
    public function __construct(string $root, int $code = 0, Exception $previous = null)
    {
        $message = sprintf('The path [ %s ] is not a valid folder.', $root);
        parent::__construct($message, $code, $previous);
    }
}

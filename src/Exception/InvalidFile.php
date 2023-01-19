<?php declare(strict_types=1);

namespace Zvax\Storage\Exception;

use Exception;

final class InvalidFile extends Exception
{
    public function __construct(string $file, int $code = 0, Exception $previous = null)
    {
        $message = sprintf("The file [ %s ] doesn't exist", $file);
        parent::__construct($message, $code, $previous);
    }
}

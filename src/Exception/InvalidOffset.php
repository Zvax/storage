<?php declare(strict_types=1);

namespace Zvax\Storage\Exception;

use Throwable;

class InvalidOffset extends \Exception
{
    public function __construct(string $offset, int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf('Invalid offset %s', $offset);
        parent::__construct($message, $code, $previous);
    }

}

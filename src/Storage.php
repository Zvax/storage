<?php declare(strict_types=1);

namespace Zvax\Storage;

use ArrayAccess;
use Iterator;

/**
 * @extends ArrayAccess<string, string>
 * @extends Iterator<string, string>
 */
interface Storage extends ArrayAccess, Iterator {}

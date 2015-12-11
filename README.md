#Storage

the file loader either returns either

 - the content of a file as a string
 - a File object you can require
 
 ```php
$loader = new \Storage\FileLoader(__DIR__.'/path/to/base/path','optionalextension');
echo $loader->getAsString('file');
$file = $loader->load('file');
require $file;
 ```
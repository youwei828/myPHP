<?php
require('./vendor/autoload.php');

use NoahBuscher\Macaw\Macaw;

Macaw::get("/index","controllers\Test@index");
Macaw::get("/hello","controllers\Hello@hello");

Macaw::any('/a', function() {
    echo 'The slug is,<hr/> ';
  });
Macaw::dispatch();


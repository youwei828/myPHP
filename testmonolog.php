<?php
require "./vendor/autoload.php";
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler(__DIR__.'/your.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');
?>
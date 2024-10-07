<?php

require __DIR__.'/../vendor/autoload.php';

require __DIR__.'/../include/web.php';

use App\Base;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

try {
    new Base($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (Exception $exception) {
    print "Error!: " . $exception->getMessage();
}

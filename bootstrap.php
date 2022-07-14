<?php
require_once __DIR__ . '/vendor/autoload.php';

use Whoops\Run;
use Dotenv\Dotenv;
use Whoops\Handler\PrettyPageHandler;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;



// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

$capsule->addConnection([
    'driver' => 'sqlsrv',
    'host' => 'SERVER-PC',
    'database' => 'DTRPayroll',
    'username' => 'sa',
    'password' => 'nicole',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);



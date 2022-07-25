<?php
require_once __DIR__ . '/vendor/autoload.php';

use Whoops\Run;
use Dotenv\Dotenv;
use Whoops\Handler\PrettyPageHandler;
use Illuminate\Database\Capsule\Manager as Capsule;

session_start();

$capsule = new Capsule;

$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

$capsule->addConnection([
    'driver' => 'sqlsrv',
    'host' => 'DESKTOP-8I07SGE',
    'database' => 'DTRPayroll',
    'username' => 'sa',
    'password' => 'christopher',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);





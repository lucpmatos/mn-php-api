<?php

require __DIR__.'/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'mn_laravel_api',
    'username'  => 'root',
    'password'  => 'LPM@lucas_11',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Configure Eloquent ORM...
$capsule->setAsGlobal();

// Init Eloquent ORM...
$capsule->bootEloquent();

<?php

use Miqu\Core\App;

require 'vendor/autoload.php';

global $container;
$app = $container->Resolve(App::class);
$app->start();
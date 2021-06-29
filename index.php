<?php

require 'vendor/autoload.php';

global $container;
$app = $container->Resolve(Miqu\Core\App::class);
$app->start();
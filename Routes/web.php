<?php

use Miqu\Core\Http\Route;
use Controllers\Auth\ForgotPasswordController;
use Controllers\Auth\LoginController;
use Controllers\Auth\LogoutController;
use Controllers\Auth\RegisterController;
use Controllers\Auth\ResetPasswordController;
use Controllers\DataTablesController;
use Controllers\HomeController;
use League\Route\RouteGroup;
use Middlewares\Authorize;
use Middlewares\UserLanguage;
use Miqu\Core\Security\Middlewares\Authenticate;

$default_middlewares = collect([
    Authenticate::class,
    Authorize::class,
    UserLanguage::class
])->map(function($class) {
    return app()->make($class);
})->all();

Route::group('account', function(RouteGroup $group) {
    $group->get('login', [ LoginController::class, 'index' ])->setName('auth.login');
    $group->post('login', [ LoginController::class, 'login' ]);

    $group->get('logout', [ LogoutController::class, 'index' ])->setName('auth.logout');
    $group->get('lock', [ LogoutController::class, 'lock' ])->setName('auth.lock');

    $group->get('register', [ RegisterController::class, 'index' ])->setName('auth.register');
    $group->post('register', [ RegisterController::class, 'register' ]);

    $group->get('forgot-password', [ ForgotPasswordController::class, 'index' ])->setName('auth.forgot-password');
    $group->post('forgot-password', [ ForgotPasswordController::class, 'reset' ]);

    $group->get('reset-password/{token}', [ ResetPasswordController::class, 'index' ])->setName('auth.reset-password');
    $group->post('reset-password/{token}', [ ResetPasswordController::class, 'reset' ]);
});

Route::get('/', [ HomeController::class, 'index' ])->setName('home');

Route::group('/data-tables', function(RouteGroup $group) {
    $group->map('POST', '/data', [ DataTablesController::class, 'index' ]);
    $group->map('GET', '/data', [ DataTablesController::class, 'index' ]);
});
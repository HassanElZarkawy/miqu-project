<?php

namespace Services\Providers;

use Miqu\Core\ServiceProvider;
use Repositories\Contracts\IUsersRepository;
use Repositories\UsersRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->container->Register(IUsersRepository::class, UsersRepository::class);
    }

    public function boot()
    {

    }
}
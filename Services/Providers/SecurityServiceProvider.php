<?php

namespace Services\Providers;

use Miqu\Core\ServiceProvider;
use Services\Security\Admin\AuthenticationManager;
use Services\Security\Admin\AuthorizationManager;
use Services\Security\Admin\Contracts\IAuthenticationManager;
use Services\Security\Admin\Contracts\IAuthorizationManager;
use Services\Validation\CsrfValidator;
use Services\Validation\Interfaces\ICsrfValidator;

class SecurityServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->container->Register( IAuthorizationManager::class, AuthorizationManager::class);
        $this->container->Register( IAuthenticationManager::class, AuthenticationManager::class);
        $this->container->Register(ICsrfValidator::class, CsrfValidator::class);
    }
}
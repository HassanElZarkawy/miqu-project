<?php

namespace Services\Providers;

use Miqu\Core\Security\Csrf\CsrfValidator;
use Miqu\Core\Security\Csrf\ICsrfValidator;
use Miqu\Core\ServiceProvider;
use Services\Security\AuthenticationManager;
use Services\Security\AuthorizationManager;
use Services\Security\Contracts\IAuthenticationManager;
use Services\Security\Contracts\IAuthorizationManager;

class SecurityServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->container->Register( IAuthorizationManager::class, AuthorizationManager::class);
        $this->container->Register( IAuthenticationManager::class, AuthenticationManager::class);
        $this->container->Register(ICsrfValidator::class, CsrfValidator::class);
    }
}
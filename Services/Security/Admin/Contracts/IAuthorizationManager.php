<?php

namespace Services\Security\Admin\Contracts;

interface IAuthorizationManager
{
    function Can( string $permission ) : bool;

    function CanAccessSystem() : bool;

    function AttachToRoles( int $user_id, array $roles );
}
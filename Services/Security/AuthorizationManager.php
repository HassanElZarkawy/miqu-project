<?php

namespace Services\Security;

use Exception;
use Miqu\Core\Models\Security\Role;
use Miqu\Core\Models\Security\UserRole;

class AuthorizationManager implements Contracts\IAuthorizationManager
{
    /**
     * @throws Exception
     */
    public function Can(string $permission ) : bool
    {
        return true;
    }

    /**
     * @throws Exception
     */
    public function CanAccessSystem() : bool
    {
        return true;
    }

    /**
     * @throws Exception
     */
    public function AttachToRoles(int $user_id, array $roles )
    {
        UserRole::where( 'user_id', $user_id )->delete();
        collect($roles)->each(function($role_id) use($user_id) {
            UserRole::create([
                'user_id' => $user_id,
                'role_id' => $role_id
            ]);
        });
    }

    /**
     * Checks if a roles exists or not
     * @param int $role_id
     * @return bool
     * @throws Exception
     */
    private function roleExists( int $role_id ) : bool
    {
        return Role::where( 'id', $role_id )->first() !== null;
    }
}
<?php

namespace Services\Security\Admin;

use Miqu\Core\Authentication;
use Exception;
use Models\Security\Role;
use Models\Security\UserRole;
use Models\User;

class AuthorizationManager implements Contracts\IAuthorizationManager
{
    /**
     * @var User
     */
    private $user;

    private const ADMIN  = 'admin';

    private const TEACHER  = 'teacher';

    private const STUDENT = 'student';

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->user = (new Authentication)->user();
    }

    /**
     * @throws Exception
     */
    public function Can(string $permission ) : bool
    {
        if ( ! $this->user )
            return false;

        if ( $this->user->type === self::STUDENT )
            return false;

        if ( $this->user->type === self::ADMIN )
            return true;

        foreach( $this->user->permissions() as $p )
            if ( $p->name == $permission || $p->slug == $permission )
                return true;

        return false;
    }

    /**
     * @throws Exception
     */
    public function CanAccessSystem() : bool
    {
        if ( ! $this->user )
            $this->user = (new Authentication)->user();

        if ( $this->user->type === self::ADMIN || $this->user->type === self::TEACHER )
            return true;

        return false;
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
<?php

namespace Repositories;

use Events\UserRegistered;
use Exception;
use Models\Security\Role;
use Models\User;
use Repositories\Contracts\IUsersRepository;
use Services\Security\Contracts\IAuthorizationManager;

class UsersRepository implements IUsersRepository
{
    private $required = [
        'name', 'email', 'username', 'password', 'type', 'status'
    ];
    /**
     * @var IAuthorizationManager
     */
    private $authorizationManager;

    /**
     * UsersRepository constructor.
     * @param IAuthorizationManager $authorizationManager
     */
    public function __construct(IAuthorizationManager $authorizationManager)
    {
        $this->authorizationManager = $authorizationManager;
    }

    /**
     * @throws Exception
     */
    public function find(int $id)
    {
        return User::where('id', $id)->first();
    }

    /**
     * @throws Exception
     */
    public function create(array $data): ?User
    {
        if ( ! $this->areRequiredFieldsPresent($data) )
            return null;

        $data[ 'password' ] = password_hash( $data[ 'password' ], PASSWORD_DEFAULT );

        $user = User::create($data);
        if ( $user === null )
            return null;

        $role_id = $this->getDefaultRole($data[ 'type' ]);
        if ( $role_id !== null )
            $this->authorizationManager->AttachToRoles( $user->id, [ $role_id ] );

        event( new UserRegistered( $user ) );

        return $user;
    }

    public function update(int $id, array $data): ?User
    {
        return null;
    }

    /**
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        $user = $this->find($id);
        if ( $user === null )
            return false;
        return $user->delete();
    }

    /**
     * @param string $email
     * @return bool
     * @throws Exception
     */
    public function emailExists(string $email) : bool
    {
        return $this->fromEmail($email) !== null;
    }

    /**
     * @param string $username
     * @return bool
     * @throws Exception
     */
    public function usernameExists(string $username) : bool
    {
        return $this->fromUsername($username) !== null;
    }

    /**
     * @param string $email
     * @return User|null
     * @throws Exception
     */
    public function fromEmail(string $email) : ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param string $username
     * @return User|null
     * @throws Exception
     */
    public function fromUsername(string $username) : ?User
    {
        return User::where('username', $username)->first();
    }

    private function areRequiredFieldsPresent(array $data) : bool
    {
        return collect($data)->filter(function($value, $key) {
            return in_array( $key, $this->required );
        })->count() === count( $data );
    }

    /**
     * @param string $type
     * @return int
     */
    private function getDefaultRole(string $type) : int
    {
        /** @var Role $role */
        $role = Role::where('slug', $type)->first();

        if ( $role === null )
            $role = Role::create([
                'name' => ucfirst($type),
                'slug' => (string)string($type)->slugify(),
                'description' => ''
            ]);

        return $role->id;
    }
}
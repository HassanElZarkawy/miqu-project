<?php /** @noinspection PhpUnusedPrivateMethodInspection */

namespace Models\Traits;

use Exception;
use Models\Security\Permission;
use Models\Security\RolePermission;

trait HasPermission
{
    /**
     * @var Permission[]
     */
    private $permissions = [];

    private function initPermissions()
    {
        if( count( $this->permissions ) === 0 )
        {
            $roles = $this->roles();
            foreach( $roles as $role )
            {
                $relations = RolePermission::where( 'role_id', $role->id )->get()->pluck( 'permissions_id' );
                Permission::in( 'id', $relations )->get()->each(function($item) {
                    $this->permissions[] = $item;
                });
            }
        }

    }

    /**
     * @return array
     * @throws Exception
     */
    protected function permissions() : array
    {
        $this->initPermissions();
        return $this->permissions;
    }

    /**
     * @param string $name
     * @return bool
     * @throws Exception
     */
    private function hasPermission(string $name ) : bool
    {
        $this->initPermissions();
        return collect($this->permissions)->first(function($item) use ($name) {
            return $item->name === $name;
        }) !== null;
    }
}
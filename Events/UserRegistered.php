<?php

namespace Events;

use Miqu\Core\Events\EventBase;
use Models\User;

class UserRegistered extends EventBase
{
    /**
     * this property should be available in the listeners classes
     * @var User
     */
    public $user;

    /**
     * Fired in Repositories\UsersRepository::class right after a new user is being created
     * UserRegistered constructor.
     * @param User $user
     */
    public function __construct( User $user )
    {
        $this->user = $user;
    }

    /**
     * {inheritdoc}
     */
    public function boot() : void
    {
        $this->listeners = [
            // add your listeners here
            // Listener::class
        ];
    }
}
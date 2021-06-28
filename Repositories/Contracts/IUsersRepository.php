<?php

namespace Repositories\Contracts;

use Models\User;

interface IUsersRepository extends IRepository
{
    public function emailExists(string $email) : bool;

    public function usernameExists(string $username) : bool;

    public function fromEmail(string $email) : ?User;

    public function fromUsername(string $username) : ?User;
}
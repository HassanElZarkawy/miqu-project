<?php

namespace Repositories\Contracts;

use Models\User;

interface IRepository
{
    public function find(int $id);

    public function create(array $data) : ?User;

    public function update(int $id, array $data) : ?User;

    public function delete(int $id) : bool;
}
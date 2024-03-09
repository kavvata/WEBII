<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Permission());
    }

    public function selectAllWith(array $orm): mixed
    {
        return $this->model::with($orm)->get();
    }
}

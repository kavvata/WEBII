<?php

namespace App\Repositories;

use App\Models\Turma;

class TurmaRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Turma());
    }

    public function selectAllWith(array $orm)
    {
        return $this->model::with($orm)->get();
    }
}

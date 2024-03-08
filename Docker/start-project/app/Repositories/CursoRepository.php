<?php

namespace App\Repositories;

use App\Models\Curso;

class CursoRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Curso);
    }

    public function selectAllWith(array $orm)
    {
        return $this->model::with($orm)->get();
    }
}

<?php 

namespace App\Repositories;

use App\Models\Curso;

class CursoRepository extends Repository { 

    protected $rows = 2;

    public function __construct() {
        parent::__construct(new Curso());
    }   

    public function getRows() { return $this->rows; }
}
<?php

namespace App\Repositories;

use Exception;

class Repository {
    protected object $model;

    protected function __construct(object $model) {
        $this->model = $model;
    }

    public function selectAll(){
        return $this->model->all();
    }

    public function findById(int $id) {
        return $this->model->find($id);
    }

    public function findDeleteById(int $id) {
        return $this->model->onlyTrashed()->find($id);
    }

    public function findByColumn($column, $value) {
        return $this->model->where($column, $value)->get();
    }

    public function findFirstByColumn($column, $value) {
        return $this->model->where($column, $value)->get()->first();
    }

    public function save($obj): bool {
        try {
            $obj->save();
            return true;
        } catch (Exception $e) {
            dd($e);
        }
    }
}

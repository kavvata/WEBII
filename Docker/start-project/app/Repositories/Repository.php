<?php

namespace App\Repositories;

use Exception;

class Repository {
    protected object $model;

    protected function __construct(object $model) {
        $this->model = $model;
    }

    public function selectAll() : object {
        return $this->model->all();
    }

    public function findById(int $id) : object {
        return $this->model->find($id);
    }

    public function findDeleteById(int $id) : object {
        return $this->model->onlyTrashed()->find($id);
    }

    public function findByColumn($column, $value) : object {
        return $this->model->where($column, $value)->get();
    }

    public function findFirstByColumn($column, $value) : object {
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

    public function delete(int $id) : bool {
        $obj = $this->findById($id);

        if(!isset($obj)) {
            return false;
        }

        try {
            $obj->delete();
            return true;
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function restore($id): bool {
        $obj = $this->findById($id);

        if(isset($obj)) {
            return false;
        }

        try {
            $obj->restore();
            return true;
        } catch (Exception $e) {
            dd($e);
        }
    }

}

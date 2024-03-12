<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Exception;

class Repository
{
    protected $model;

    protected function __construct(object $model)
    {
        $this->model = $model;
    }

    public function selectAll(): object
    {
        return $this->model->all();
    }

    public function selectAllWith(array $orms): mixed
    {
        return $this->model::with($orms)->get();
    }

    public function findById(int $id): object
    {
        return $this->model->find($id);
    }

    public function findByIdWith(int $id, array $orms): object
    {
        return $this->model::with($orms)->find($id);
    }

    public function findDeleteById(int $id): object
    {
        return $this->model->onlyTrashed()->find($id);
    }

    public function findByColumn($column, $value): object
    {
        return $this->model->where($column, $value)->get();
    }

    public function findFirstByColumn($column, $value): object
    {
        return $this->model->where($column, $value)->get()->first();
    }

    public function save($obj): bool
    {
        try {
            $obj->save();
            return true;
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function delete(int $id): bool
    {
        $obj = $this->findById($id);

        if (!isset($obj)) {
            return false;
        }

        try {
            $obj->delete();
            return true;
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function restore(int $id): bool
    {
        $obj = $this->findById($id);

        if (isset($obj)) {
            return false;
        }

        try {
            $obj->restore();
            return true;
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function createRule(array $keys, array $ids): array
    {
        $arr = array();

        for ($i = 0; $i < count($ids); $i++) {
            $arr[$i] = [$keys[$i], (integer) $ids[$i]];
        }

        return $arr;
    }

    public function findByCompositeId(array $keys, array $ids)
    {
        return $this->model::where($this->createRule($keys, $ids))->first();
    }

    public function findByCompositeIdWith(array $keys, array $ids, array $orms)
    {
        return $this->model::with($orms)
            ->where($this->createRule($keys, $ids))
            ->first();
    }

    public function updateCompositeId($keys, $ids, $table, $values): bool
    {
        try {
            DB::table($table)
                ->where($this->createRule($keys, $ids))
                ->update($values);

            return true;
        } catch (Exception $e) {
            dd($e);
        }

        return false;
    }

    public function deleteCompositeId($keys, $ids, $table): bool
    {
        try {
            DB::table($table)->where($this->createRule($keys, $ids))->delete();

            return true;
        } catch (Exception $e) {
            dd($e);
        }
        return false;
    }
}

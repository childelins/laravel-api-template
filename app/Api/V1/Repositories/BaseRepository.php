<?php

namespace App\Api\V1\Repositories;

use DB;

abstract class BaseRepository
{
    protected $table;

    protected $primaryKey = 'id';

    protected $fillable = [];

    public function all($conditions = [])
    {
        return $this->builder($conditions)->get();
    }

    public function count($conditions = [])
    {
        return $this->builder($conditions)->count();
    }

    public function paginate($conditions = [], $options = ['order' => 'createdAt', 'sort' => 'desc', 'limit' => 20])
    {
        return $this->builder($conditions)->orderBy($options['order'], $options['sort'])->paginate($options['limit']);
    }

    public function find($id, $conditions = [])
    {
        return $this->builder($conditions)->where($this->condition($id))->first();
    }

    public function create($data)
    {
        $data = $this->checkRequireParams($data);
        $data['createdAt'] = now();

        $this->queryBuilder()->insert($data);
    }

    public function createAndGetId($data)
    {
        $data = $this->checkRequireParams($data);
        $data['createdAt'] = now();

        return $this->queryBuilder()->insertGetId($data);
    }

    public function update($id, $data)
    {
        $data = $this->checkRequireParams($data);
        $data['updatedAt'] = now();

        $this->queryBuilder()->where($this->condition($id))->update($data);
    }

    public function delete($id)
    {
        $this->queryBuilder()->where($this->condition($id))->delete();
    }

    protected function queryBuilder()
    {
        return DB::table($this->table);
    }

    protected function condition($id)
    {
        return [$this->primaryKey => $id];
    }

    protected function builder($conditions)
    {
        $builder = $this->queryBuilder();

        if (!empty($conditions)) {
            $builder->where($conditions);
        }

        return $builder;
    }

    protected function checkRequireParams($params)
    {
        if (!empty($this->fillable)) {
            foreach ($params as $key => $value) {
                if (!in_array($key, $this->fillable)) {
                    unset($params[$key]);
                }
            }
        }

        return $params;
    }
}

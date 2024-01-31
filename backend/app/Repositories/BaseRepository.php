<?php

namespace App\Repositories;

use App\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected string $model;

    abstract function getModelClass(): string;

    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    public function find(string $column, string|int $value): ?Model
    {
        return $this->model->where($column, $value)->first();
    }

    public function findById(int $id): ?Model
    {
        return $this->find('id', $id);
    }

    public function create(array $data): Model
    {
        $model = new $this->model;
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function update(int $id, array $data): Model
    {
        $model = $this->findById($id);
        $model->fill($data);
        $model->update();
        return $model;
    }

    public function destroy(int $id): bool
    {
        $model = $this->findById($id);
        return $model ? $model->delete() : false;
    }

    public function list(array $data = []): Collection
    {
        return $this->model::when(!empty($data['select']), function ($q) use ($data) {
            $q->select($data['select']);
        })->when(isset($data['orderBy']), function ($q) use ($data) {
            $q->orderBy($data['orderBy'], $data['orderType'] ?? 'desc');
        })->when(!empty($data['with']), function ($q) use ($data) {
            $q->with($data['with']);
        })->get();
    }

    public function updateRelations(Model $model, array $data, string $type): void
    {
        foreach ($data as $key => $value) {
            $model->{$key}()->{$type}($value);
        }
    }
}

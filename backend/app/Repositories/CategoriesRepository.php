<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoriesRepository extends BaseRepository
{
    final function getModelClass(): string
    {
        return Category::class;
    }

    final public function create(array $data): Model
    {
        $model = new $this->model;
        $model->save();

        $relations = [
            'attributes' => $data['attributes'],
            'meta' => $data['meta'],
        ];

        $this->updateRelations($model, $relations, 'create');

        return $model;
    }

    final public function update(int $id, array $data): Model
    {
        $model = $this->findById($id);
        $model->update();

        $relations = [
            'attributes' => $data['attributes'],
            'meta' => $data['meta'],
        ];

        $this->updateRelations($model, $relations, 'update');

        return $model;
    }

    final public function destroy(int $id): bool
    {
        $model = $this->findById($id);
        if (!$model) {
            return false;
        }
        $model->attributes()->delete();
        $model->meta()->delete();
        return $model->delete();
    }
}

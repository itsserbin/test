<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryInterface
{
    public function list(array $data = []): Collection;

    public function findById(int $id): ?Model;

    public function create(array $data): Model;

    public function update(int $id, array $data): Model;

    public function destroy(int $id): bool;
}

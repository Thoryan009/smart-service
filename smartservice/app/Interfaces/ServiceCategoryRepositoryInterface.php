<?php

namespace App\Interfaces;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Collection;

interface ServiceCategoryRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): ServiceCategory;
    public function find( int $id): ?ServiceCategory;
    public function update(array $data, int $id): bool;
    public function delete(int $id): bool;
}

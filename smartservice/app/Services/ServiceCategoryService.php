<?php

namespace App\Services;

use App\DTOs\ServiceCategoryDTO;
use App\Interfaces\ServiceCategoryRepositoryInterface;
use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Collection;

class ServiceCategoryService
{
    protected ServiceCategoryRepositoryInterface $repository;

    public function __construct(ServiceCategoryRepositoryInterface $repository)

    {
        $this->repository = $repository;    
    }

    public function getAll(): Collection
    {
       return $this->repository->all();
    }

    public function create(ServiceCategoryDTO $dto): ?ServiceCategory
    {
        return $this->repository->create($dto->toArray());
    }

    public function find(int $id): ?ServiceCategory
    {
        return $this->repository->find($id);
    }

    public function update(ServiceCategoryDTO $dto, int $id): bool
    {
        return $this->repository->update( $dto->toArray(), $id);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

}
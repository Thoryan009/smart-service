<?php

namespace App\Services;

use App\DTOs\ServiceCategoryDTO;
use App\Interfaces\ServiceCategoryRepositoryInterface;
use App\Models\ServiceCategory;

class ServiceCategoryService
{
    protected ServiceCategoryRepositoryInterface $repository;

    public function __construct(ServiceCategoryRepositoryInterface $repository)

    {
        $this->repository = $repository;    
    }

    public function getAll()
    {
       return $this->repository->all();
    }

    public function create(ServiceCategoryDTO $dto)
    {
        return $this->repository->create($dto->toArray());
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function update(ServiceCategoryDTO $dto, $id)
    {
        return $this->repository->update( $dto->toArray(), $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

}
<?php

namespace App\Repositories\ServiceCategory;

use App\Interfaces\ServiceCategoryRepositoryInterface;
use App\Models\ServiceCategory;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Database\Eloquent\Collection;

// use Symfony\Contracts\Service\ServiceProviderInterface;

class EloquentServiceCategoryRepository implements ServiceCategoryRepositoryInterface
{
    public function all(): Collection
    {
        $service_categories = ServiceCategory::all();
        return $service_categories;
        
    }

    public function create(array $data): ServiceCategory

    {
        $service_category = new ServiceCategory();
        $service_category->name = $data['name'];
        $service_category->description = $data['description'];

        $service_category->save();

        return $service_category;
    }
    public function find(int $id): ?ServiceCategory
    {
        $service_category = ServiceCategory::find($id);
        return $service_category;
    }

    public function update(array $data,int $id): bool
    {
        $service_category = ServiceCategory::find($id);
        $service_category->name = $data['name'];
        $service_category->description = $data['description'];
        $service_category->save();
        return $service_category ? true : false;
    }

    public function delete(int $id):bool
    {
        $service_category = ServiceCategory::find($id);
        return $service_category->delete() ?? false;
    }
}

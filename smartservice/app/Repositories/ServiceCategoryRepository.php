<?php

namespace App\Repositories;

use App\Interfaces\ServiceCategoryRepositoryInterface;
use App\Models\ServiceCategory;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\FuncCall;

// use Symfony\Contracts\Service\ServiceProviderInterface;

class ServiceCategoryRepository implements ServiceCategoryRepositoryInterface
{
    public function all()
    {
        $service_categories = ServiceCategory::all();
        return $service_categories;
        
    }

    public function create(array $data)

    {
        $service_category = new ServiceCategory();
        $service_category->name = $data['name'];
        $service_category->description = $data['description'];

        $service_category->save();

        return $service_category;
    }
    public function find($id)
    {
        $service_category = ServiceCategory::find($id);
        return $service_category;
    }

    public function update(array $data, $id)
    {
        $service_category = ServiceCategory::find($id);
        $service_category->name = $data['name'];
        $service_category->description = $data['description'];
        $service_category->save();
        return $service_category;
    }

    public function delete($id)
    {
        $service_category = ServiceCategory::find($id);
        return $service_category->delete();
    }
}

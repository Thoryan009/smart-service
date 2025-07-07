<?php

namespace App\Http\Controllers\API;

use App\DTOs\ServiceCategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Resource\ServiceCategoryResource;
use App\Services\ServiceCategoryService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    use ApiResponseTrait;
    protected ServiceCategoryService $service;

    public function __construct(ServiceCategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->getAll();
        if (!$categories) {
            return $this->error('Something is not working. Please try again');
        }
        elseif($categories->isEmpty())
        {
             return $this->success(ServiceCategoryResource::collection($categories), 'No Data found');
        }
        return $this->success(ServiceCategoryResource::collection($categories), 'data retrived successfully');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $dto = ServiceCategoryDTO::fromArray($validated);
        // return $dto;
        dd(gettype($dto));
        $created = $this->service->create($dto);

        if (!$created) {
             return $this->error('Data ta pauya jacche nah', 404);
        }

         return $this->success(new ServiceCategoryResource($created), 'created', 201);
    }

    public function show($id)
    {
        $data = $this->service->find($id);

        if (!$data) {
            return $this->error('Data ta pauya jacche nah', 404);
        }
        return $this->success(new ServiceCategoryResource($data), 'Data Found', 302);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $dto = ServiceCategoryDTO::fromArray($validated);
        $updated = $this->service->update($dto, $id);

        if (!$updated) {
            return $this->error('Update Unsuccessfull', 400);
        }
        return $this->success(new ServiceCategoryResource($updated), 'Update Successfull');
    }

    public function destroy($id)
    {

        // return response()->json([
        //     'message' => 'Deleted Successfully',
        //     'data' =>  $this->service->delete($id)
        // ]);
        return $this->success($this->service->delete($id) , 'deleted successfull', 410);
    }
}

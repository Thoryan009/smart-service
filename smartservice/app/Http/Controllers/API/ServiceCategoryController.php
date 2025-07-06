<?php

namespace App\Http\Controllers\API;

use App\DTOs\ServiceCategoryDTO;
use App\Http\Controllers\Controller;
use App\Services\ServiceCategoryService;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    protected ServiceCategoryService $service;

    public function __construct(ServiceCategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json([
            'data' => $this->service->getAll()
        ],200);

    }

    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $dto = ServiceCategoryDTO::fromArray($validated);
        $created = $this->service->create($dto);
        return response()->json([
            'message' => 'Created Successfully.',
            'data' => $created
        ], 201);
    }

    public function show($id)
    {
        return response()->json([
            'data' => $this->service->find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $dto = ServiceCategoryDTO::fromArray($validated);
        $updated = $this->service->update(  $dto, $id);

        return response()->json([
            'message' => 'Updated Successfully',
            'data' =>$updated
        ],200);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json([
            'message' => 'Deleted Successfully'
        ]);
    }
}

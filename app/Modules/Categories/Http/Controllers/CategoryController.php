<?php

namespace App\Modules\Categories\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Http\Requests\CategoryStoreRequest;
use App\Modules\Categories\Http\Resources\CategoryResource;
use App\Modules\Categories\Models\Category;
use App\Modules\Categories\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepository $repository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        return CategoryResource::collection($this->repository->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request): JsonResponse|CategoryResource
    {
        return new CategoryResource($this->repository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $model): JsonResponse|CategoryResource
    {
        return new CategoryResource($this->repository->find($model));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryStoreRequest $request, Category $model): JsonResponse|CategoryResource
    {
        return new CategoryResource($this->repository->update($request->validated(), $model));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $model): JsonResponse
    {
        $this->repository->delete($model);
        return response()->json(['message' => "Successful deleted record"], 204);
    }
}

<?php

namespace App\Modules\Categories\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Http\Requests\ChildCategoryStoreRequest;
use App\Modules\Categories\Http\Resources\ChildCategoryResource;
use App\Modules\Categories\Models\ChildCategory;
use App\Modules\Categories\Repositories\ChildCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChildCategoryController extends Controller
{
    public function __construct(
        private ChildCategoryRepository $repository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        return ChildCategoryResource::collection($this->repository->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChildCategoryStoreRequest $request): JsonResponse|ChildCategoryResource
    {
        return new ChildCategoryResource($this->repository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(ChildCategory $model): JsonResponse|ChildCategoryResource
    {
        return new ChildCategoryResource($this->repository->find($model));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChildCategoryStoreRequest $request, ChildCategory $model): JsonResponse|ChildCategoryResource
    {
        return new ChildCategoryResource($this->repository->update($request->validated(), $model));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildCategory $model): JsonResponse
    {
        $this->repository->delete($model);
        return response()->json(['message' => "Successful deleted record"], 204);
    }
}

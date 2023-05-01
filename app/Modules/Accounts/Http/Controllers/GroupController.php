<?php

namespace App\Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Accounts\Http\Resources\GroupResource;
use App\Modules\Accounts\Models\Group;
use App\Modules\Accounts\Repositories\GroupRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupController extends Controller
{
    public function __construct(
        private GroupRepository $repository
    ) {}

    /**
     * Display a listing of the resource type relationship.
     */
    public function types(): JsonResponse
    {
        return response()->json(['data' => $this->repository->types()]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse|AnonymousResourceCollection
    {
        return GroupResource::collection($this->repository->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $model): JsonResponse|GroupResource
    {
        return new GroupResource($this->repository->find($model));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse|GroupResource
    {
        return new GroupResource($this->repository->create($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $model): JsonResponse|GroupResource
    {
        return new GroupResource($this->repository->update($request->validated(), $model));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $model): JsonResponse
    {
        $this->repository->delete($model);
        return response()->json(['message' => "Successful deleted record"], 204);
    }
}

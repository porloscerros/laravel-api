<?php

namespace App\Modules\Categories\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Http\Resources\GroupResource;
use App\Modules\Categories\Models\Group;
use App\Modules\Categories\Repositories\GroupRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupController extends Controller
{
    public function __construct(
        private GroupRepository $repository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        return GroupResource::collection($this->repository->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse|GroupResource
    {
        return new GroupResource($this->repository->create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $model): JsonResponse|GroupResource
    {
        return new GroupResource( $this->repository->find($model));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $model): JsonResponse|GroupResource
    {
        return new GroupResource($this->repository->update($request->all(), $model));
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

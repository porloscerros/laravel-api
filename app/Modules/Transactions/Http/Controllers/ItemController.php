<?php

namespace App\Modules\Transactions\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Transactions\Models\Item;
use App\Modules\Transactions\Repositories\ItemRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(
        private ItemRepository $repository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->repository->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->repository->create($request->all())]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $model): JsonResponse
    {
        return response()->json(['data' => $this->repository->find($model)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $model): JsonResponse
    {
        return response()->json(['data' => $this->repository->update($request->all(), $model)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $model): JsonResponse
    {
        $this->repository->delete($model);
        return response()->json(['message' => "Successful deleted record"], 204);
    }
}

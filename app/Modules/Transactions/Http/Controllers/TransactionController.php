<?php

namespace App\Modules\Transactions\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Transactions\Http\Requests\TransactionImportRequest;
use App\Modules\Transactions\Http\Requests\TransactionStoreRequest;
use App\Modules\Transactions\Http\Requests\TransactionUpdateRequest;
use App\Modules\Transactions\Models\Transaction;
use App\Modules\Transactions\Repositories\TransactionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private TransactionRepository $repository
    ) {}

    /**
     * Bulk upsert.
     */
    public function import(TransactionImportRequest $request): JsonResponse
    {
        return response()->json(['data' => $this->repository->import($request->validated())]);
    }

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
    public function store(TransactionStoreRequest $request): JsonResponse
    {
        return response()->json(['data' => $this->repository->create($request->validated())]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $model): JsonResponse
    {
        return response()->json(['data' => $this->repository->find($model)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionUpdateRequest $request, Transaction $model): JsonResponse
    {
        return response()->json(['data' => $this->repository->update($request->validated(), $model)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $model): JsonResponse
    {
        $this->repository->delete($model);
        return response()->json(['message' => "Successful deleted record"], 204);
    }
}

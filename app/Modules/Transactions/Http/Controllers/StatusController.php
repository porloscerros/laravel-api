<?php

namespace App\Modules\Transactions\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Transactions\Models\Status;
use App\Modules\Transactions\Repositories\StatusRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct(
        private StatusRepository $repository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->repository->get()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $model): JsonResponse
    {
        return response()->json(['data' => $this->repository->find($model)]);
    }
}

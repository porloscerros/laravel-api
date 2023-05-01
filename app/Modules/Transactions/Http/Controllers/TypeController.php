<?php

namespace App\Modules\Transactions\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Transactions\Models\Type;
use App\Modules\Transactions\Repositories\TypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __construct(
        private TypeRepository $repository
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
    public function show(Type $model): JsonResponse
    {
        return response()->json(['data' => $this->repository->find($model)]);
    }
}

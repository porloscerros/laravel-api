<?php

namespace App\Modules\Currencies\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Currencies\Http\Requests\CurrencyStoreRequest;
use App\Modules\Currencies\Http\Requests\CurrencyUpdateRequest;
use App\Modules\Currencies\Models\Crypto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json(['data' => Crypto::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurrencyStoreRequest $request): JsonResponse
    {
        // @TODO
        return response()->json(['message' => 'not available']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Crypto $model): JsonResponse
    {
        return response()->json(['data' => $model]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CurrencyUpdateRequest $request, Crypto $model): JsonResponse
    {
        // @TODO
        return response()->json(['message' => 'not available']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crypto $model): JsonResponse
    {
        // @TODO
        return response()->json(['message' => 'not available']);
    }
}

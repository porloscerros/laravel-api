<?php

namespace App\Modules\Currencies\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Currencies\Http\Requests\CurrencyStoreRequest;
use App\Modules\Currencies\Http\Requests\CurrencyUpdateRequest;
use App\Modules\Currencies\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json(['data' => Currency::all()]);
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
    public function show(Currency $model): JsonResponse
    {
        return response()->json(['data' => $model]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CurrencyUpdateRequest $request, Currency $model): JsonResponse
    {
        // @TODO
        return response()->json(['message' => 'not available']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $model): JsonResponse
    {
        // @TODO
        return response()->json(['message' => 'not available']);
    }
}

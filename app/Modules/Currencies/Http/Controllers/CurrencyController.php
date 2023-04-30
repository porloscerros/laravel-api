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
    public function index(): JsonResponse
    {
        return response()->json(['data' => Currency::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CurrencyStoreRequest $request
     */
    public function store(CurrencyStoreRequest $request): JsonResponse
    {
        // @TODO
        return response()->json(['message' => 'not available']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Currency  $currency
     */
    public function show(Currency $currency): JsonResponse
    {
        return response()->json(['data' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CurrencyUpdateRequest  $request
     * @param  Currency  $currency
     */
    public function update(CurrencyUpdateRequest $request, Currency $currency): JsonResponse
    {
        // @TODO
        return response()->json(['message' => 'not available']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Currency  $currency
     */
    public function destroy(Currency $currency): JsonResponse
    {
        // @TODO
        return response()->json(['message' => 'not available']);
    }
}

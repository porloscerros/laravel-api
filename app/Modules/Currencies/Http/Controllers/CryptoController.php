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
    public function index(): JsonResponse
    {
        return response()->json(['data' => Crypto::all()]);
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
     * @param  Crypto  $crypto
     */
    public function show(Crypto $crypto): JsonResponse
    {
        return response()->json(['data' => $crypto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CurrencyUpdateRequest  $request
     * @param  Crypto  $crypto
     */
    public function update(CurrencyUpdateRequest $request, Crypto $crypto): JsonResponse
    {
        // @TODO
        return response()->json(['message' => 'not available']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Crypto  $crypto
     */
    public function destroy(Crypto $crypto): JsonResponse
    {
        // @TODO
        return response()->json(['message' => 'not available']);
    }
}

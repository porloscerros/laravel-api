<?php

namespace App\Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Accounts\Http\Requests\AccountStoreRequest;
use App\Modules\Accounts\Http\Resources\AccountResource;
use App\Modules\Accounts\Models\Account;
use App\Modules\Accounts\Repositories\AccountRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AccountController extends Controller
{

    public function __construct(
        private AccountRepository $repository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        return AccountResource::collection($this->repository->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountStoreRequest $request): JsonResponse|AccountResource
    {
        return new AccountResource($this->repository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account): JsonResponse|AccountResource
    {
        return new AccountResource($this->repository->find($account));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountStoreRequest $request, Account $account): JsonResponse|AccountResource
    {
        return new AccountResource($this->repository->update($request->validated(), $account));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account): JsonResponse
    {
        $this->repository->delete($account);
        return response()->json(['message' => "Successful deleted record"], 204);
    }
}

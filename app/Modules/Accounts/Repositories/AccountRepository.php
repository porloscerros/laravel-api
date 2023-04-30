<?php

namespace App\Modules\Accounts\Repositories;

use App\Modules\Accounts\Models\Account;
use Illuminate\Database\Eloquent\Collection;

class AccountRepository
{
    public function __construct(
        private array $relationships = [
            'type',
            'type.group',
            'currency',
        ]
    ) {}

    /**
     * Query filtered records and load relationships.
     */
    public function get(?array $filters = []): Collection
    {
        return Account::with($this->relationships)
            ->orderBy('currency_id', 'asc')
            ->get();
    }

    /**
     * Query given model instance or id and load relationships.
     */
    public function find(Account|int $model): Account
    {
        if(!$model instanceof Account) {
            $model = Account::findOrFail($model);
        }
        return $model->load($this->relationships);
    }

    /**
     * Insert a new record.
     */
    public function create(array $data): Account
    {
        $model = new Account;
        $model->name = $data['name'];
        $model->type_id = $data['type_id'];
        $model->currency_id = $data['currency_id'];
        // @TODO
        //$model->conversion_rate = $data['conversion_rate'] ?? null;
        //$model->cash_based_account = $data['cash_based_account'];
        //$model->opening_date = $data['opening_date'] ?? now();
        //$model->starting_balance = $data['starting_balance'] ?? 0;
        //$model->notes = $data['notes'] ?? null;
        $model->save();
        return $model;
    }

    /**
     * Update a given record.
     */
    public function update(array $data, Account|int $model): Account
    {
        if(!$model instanceof Account) {
            $model = Account::findOrFail($model);
        }
        $model->name = $data['name'];
        $model->type_id = $data['type_id'];
        $model->currency_id = $data['currency_id'];
        // @TODO
        //$model->conversion_rate = $data['conversion_rate'] ?? null;
        //$model->cash_based_account = $data['cash_based_account'];
        //$model->opening_date = $data['opening_date'] ?? $model->opening_date;
        //$model->starting_balance = $data['starting_balance'] ?? $model->starting_balance;
        //$model->notes = $data['notes'];
        $model->save();
        return $model;
    }

    /**
     * Delete the given record.
     */
    public function delete(Account|int $model): void
    {
        !$model instanceof Account
            ? Account::where("id", $model)->delete()
            : $model->delete();
    }

    /**
     * Description here.
     */
    public function import(array $data): mixed
    {
        // @TODO
        return Account::upsert(
            $data,
            ['slug', 'currency_id']
        );
    }
}

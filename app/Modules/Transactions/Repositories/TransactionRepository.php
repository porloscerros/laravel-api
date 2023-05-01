<?php

namespace App\Modules\Transactions\Repositories;

use App\Modules\Transactions\Models\Transaction;
use App\Modules\Transactions\Models\Type;
use Illuminate\Support\Collection;

class TransactionRepository
{
    public function __construct(
        private array $relationships = [
            'type',
            'account.currency',
        ]
    ) {}

    public function types(): Collection
    {
        return Type::all();
    }

    public function import(array $data): mixed
    {
        return Transaction::insert($data);
    }

    /**
     * Query filtered records and load relationships.
     */
    public function get(?array $filters = []): Collection
    {
        $from = $filters['from'] ?? false;
        $to = $filters['to'] ?? false;
        $type_id = $filters['type'] ?? false;
        $min = $filters['min'] ?? false;

        return Transaction::when($min, function ($query) {
            $query->select('date', 'name' );
        }, function ($query) {
            $query->with($this->relationships);
        })
            ->when($from, function ($query) use ($from) {
                $query->whereDate('date', '>=', $from);
            })
            ->when($to, function ($query) use ($to) {
                $query->where('date', '<=', $to);
            })
            ->when($type_id, function ($query) use ($type_id) {
                $query->where('type_id', $type_id);
            })
            ->orderBy('date', 'desc')
            ->get();
    }

    /**
     * Query given model instance or id and load relationships.
     */
    public function find($model): Transaction
    {
        if(!$model instanceof Transaction) {
            $model = Transaction::findOrFail($model);
        }
        return $model->load($this->relationships);
    }

    /**
     * Insert a new record.
     */
    public function create(array $data): Transaction
    {
        $model = new Transaction;
        $model->type_id = $data['type_id'];
        $model->account_id = $data['account_id'];
        $model->date = $data['date'];
        $model->name = $data['name'];
        $model->amount = $data['amount'];
        $model->description = $data['description'] ?? null;
        $model->save();
        return $model;
    }

    /**
     * Update a given record.
     */
    public function update(array $data, $model): Transaction
    {
        if(!$model instanceof Transaction) {
            $model = Transaction::findOrFail($model);
        }
        $model->user_id = $data['user_id'];
        $model->type_id = $data['type_id'];
        $model->account_id = $data['account_id'];
        $model->date = $data['date'];
        $model->name = $data['name'];
        $model->amount = $data['amount'];
        $model->description = $data['description'] ?? $model->description;
        $model->save();
        return $model;
    }

    /**
     * Delete the given record.
     */
    public function delete($model): void
    {
        !$model instanceof Transaction
            ? Transaction::where("id", $model)->delete()
            : $model->delete();
    }
}

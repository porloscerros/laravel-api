<?php

namespace App\Modules\Transactions\Repositories;

use App\Modules\Transactions\Models\Transaction;
use App\Modules\Transactions\Models\Type;
use Illuminate\Support\Collection;

class TypeRepository
{
    public function __construct(
        private array $relationships = [
            'type',
            'account.currency',
        ]
    ) {}

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
}

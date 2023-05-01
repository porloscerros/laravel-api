<?php

namespace App\Modules\Accounts\Repositories;

use App\Modules\Accounts\Models\Group;
use App\Modules\Accounts\Models\Type;
use Illuminate\Database\Eloquent\Collection;

class GroupRepository
{
    public function __construct(
        private array $relationships = [
            'types',
        ]
    ) {}

    /**
     * Query all accounts types.
     */
    public function types(): Collection
    {
        return Type::all();
    }

    /**
     * Query filtered records and load relationships.
     */
    public function get(?array $filters = []): Collection
    {
        return Group::with($this->relationships)
            ->get();
    }

    /**
     * Query given model instance or id and load relationships.
     */
    public function find(Group|int $model): Group
    {
        if(!$model instanceof Group) {
            $model = Group::findOrFail($model);
        }
        $model->load($this->relationships);
        return $model;
    }
}

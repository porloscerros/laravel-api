<?php

namespace App\Modules\Categories\Repositories;

use App\Modules\Categories\Models\Group;
use Illuminate\Support\Collection;

class GroupRepository
{
    public function __construct(
        private array $relationships = [
            "categories",
        ]
    ) {}

    /**
     * Query filtered records and load relationships.
     */
    public function get(?array $filters = []): Collection
    {
        return Group::with($this->relationships)
            ->orderBy('name')
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
        return $model->load($this->relationships);
    }
}

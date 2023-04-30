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

    /**
     * Insert a new record.
     */
    public function create(array $data): Group
    {
        $model = new Group;
        $model->name = $data['name'];
        $model->save();
        return $model;
    }

    /**
     * Update a given record.
     */
    public function update(array $data, Group|int $model): Group
    {
        if(!$model instanceof Group) {
            $model = Group::findOrFail($model);
        }
        $model->name = $data['name'];
        $model->save();
        return $model;
    }

    /**
     * Delete the given record.
     */
    public function delete(Group|int $model): void
    {
        !$model instanceof Group
            ? Group::where("id", $model)->delete()
            : $model->delete();
    }

    /**
     * Query all accounts types.
     */
    public function types(): Collection
    {
        return Type::all();
    }
}

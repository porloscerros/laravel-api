<?php

namespace App\Modules\Categories\Repositories;

use App\Modules\Categories\Models\ChildCategory;
use Illuminate\Support\Collection;

class ChildCategoryRepository
{
    public function __construct(
        private array $relationships = [
            "parent",
        ]
    ) {}

    /**
     * Query filtered records and load relationships.
     */
    public function get(?array $filters = []): Collection
    {
        return ChildCategory::with($this->relationships)
            ->orderBy('name')
            ->get();
    }

    /**
     * Query given model instance or id and load relationships.
     */
    public function find(ChildCategory|int $model): ChildCategory
    {
        if(!$model instanceof ChildCategory) {
            $model = ChildCategory::findOrFail($model);
        }
        return $model->load($this->relationships);
    }

    /**
     * Insert a new record.
     */
    public function create(array $data): ChildCategory
    {
        $model = new ChildCategory;
        $model->name = $data['name'];
        $model->parent_id = $data['parent_id'];
        $model->save();
        return $model;
    }

    /**
     * Update a given record.
     */
    public function update(array $data, ChildCategory|int $model): ChildCategory
    {
        if(!$model instanceof ChildCategory) {
            $model = ChildCategory::findOrFail($model);
        }
        $model->name = $data['name'];
        $model->parent_id = $data['parent_id'];
        $model->save();
        return $model;
    }

    /**
     * Delete the given record.
     */
    public function delete(ChildCategory|int $model): void
    {
        !$model instanceof ChildCategory
            ? ChildCategory::where("id", $model)->delete()
            : $model->delete();
    }
}

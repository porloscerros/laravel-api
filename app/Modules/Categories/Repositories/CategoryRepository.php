<?php

namespace App\Modules\Categories\Repositories;

use App\Modules\Categories\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository
{
    public function __construct(
        private array $relationships = [
            "group",
            "childs",
        ]
    ) {}

    /**
     * Query filtered records and load relationships.
     */
    public function get(?array $filters = []): Collection
    {
        return Category::with($this->relationships)
            ->orderBy('name')
            ->get();
    }

    /**
     * Query given model instance or id and load relationships.
     */
    public function find(Category|int $model): Category
    {
        if(!$model instanceof Category) {
            $model = Category::findOrFail($model);
        }
        return $model->load($this->relationships);
    }

    /**
     * Insert a new record.
     */
    public function create(array $data): Category
    {
        $model = new Category;
        $model->name = $data['name'];
        $model->type_id = $data['type_id'];
        $model->group_id = $data['group_id'];
        $model->save();
        return $model;
    }

    /**
     * Update a given record.
     */
    public function update(array $data, Category|int $model): Category
    {
        if(!$model instanceof Category) {
            $model = Category::findOrFail($model);
        }
        $model->name = $data['name'];
        $model->type_id = $data['type_id'];
        $model->group_id = $data['group_id'];
        $model->save();
        return $model;
    }

    /**
     * Delete the given record.
     */
    public function delete(Category|int $model): void
    {
        !$model instanceof Category
            ? Category::where("id", $model)->delete()
            : $model->delete();
    }
}

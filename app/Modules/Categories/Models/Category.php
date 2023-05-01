<?php

namespace App\Modules\Categories\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'group_id',
    ];

    /**
     * Get category's group.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get category's children.
     */
    public function childs(): HasMany
    {
        return $this->hasMany(ChildCategory::class, "parent_id");
    }
}

<?php

namespace App\Modules\Categories\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChildCategory extends Model
{
    public $timestamps = false;

    protected $table = 'categories_childs';

    protected $fillable = [
        'name',
        'parent_id',
    ];

    /**
     * Get child category's parent.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, "parent_id");
    }
}

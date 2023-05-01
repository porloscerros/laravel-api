<?php

namespace App\Modules\Categories\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    public $timestamps = false;

    protected $table = 'categories_groups';

    protected $fillable = [
        'name',
    ];

    /**
     * Get group's categories.
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}

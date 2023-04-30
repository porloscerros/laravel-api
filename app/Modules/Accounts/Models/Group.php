<?php

namespace App\Modules\Accounts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    public $timestamps = false;

    protected $table = 'accounts_groups';

    protected $fillable = [
        'name',
    ];

    /**
     * Get group's types.
     */
    public function types(): HasMany
    {
        return $this->hasMany(Type::class);
    }
}

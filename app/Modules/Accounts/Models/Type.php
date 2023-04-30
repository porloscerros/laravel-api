<?php

namespace App\Modules\Accounts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    public $timestamps = false;

    protected $table = 'accounts_types';

    protected $fillable = [
        'name',
        'group_id',
    ];

    /**
     * Get type's group.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get type's accounts.
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}

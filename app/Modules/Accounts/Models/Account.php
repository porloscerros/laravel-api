<?php

namespace App\Modules\Accounts\Models;

use App\Modules\Currencies\Models\Currency;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'type_id',
        'currency_id',
        'conversion_rate',
        'cash_based_account',
    ];

    /**
     * Get account's type.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get account's currency.
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}

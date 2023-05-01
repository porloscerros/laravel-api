<?php

namespace App\Modules\Transactions\Models;

use App\Modules\Accounts\Models\Account;
use App\Modules\Categories\Models\ChildCategory;
use App\Modules\Currencies\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = 'daybook';

    protected $fillable = [
        'type_id',
        'item_id',
        'date',
        'name',
        'amount',
        'currency_id',
        'conversion_rate',
        'account_id',
        'category_id',
        'status_id',
        'reference',
        'notes',
    ];

    protected $dates = ['date'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ChildCategory::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}

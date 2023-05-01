<?php

namespace App\Modules\Transactions\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    protected $table = 'daybook_items';

    protected $fillable = ['name'];
}

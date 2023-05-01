<?php

namespace App\Modules\Transactions\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;

    protected $table = 'daybook_types';

    protected $fillable = ['name'];
}

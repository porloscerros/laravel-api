<?php

namespace App\Modules\Transactions\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;

    protected $table = 'daybook_statuses';

    protected $fillable = ['name'];
}

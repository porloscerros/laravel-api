<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ExistsMultipleColumns implements ValidationRule
{
    /**
     * The db table name.
     * @var string
     */
    protected string $table;
    /**
     * Array of db table columns where should exist value.
     * @var array
     */
    protected array $columns;

    /**
     * Create a new rule instance.
     * @param string $table_name
     * @param  mixed  $columns
     *
     * @return void
     */
    public function __construct(string $table_name, ...$columns)
    {
        $this->table = $table_name;
        $this->columns = $columns;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = DB::table($this->table)
            ->where( array_shift($this->columns), $value );
        foreach ($this->columns as $column) {
            $query = $query->orWhere($column, $value);
        }
        if (!$query->exists()) {
            $fail('The given value does not exists on our :attribute registers.');
        }
    }
}

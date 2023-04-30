<?php

namespace App\Modules\Accounts\Http\Requests;

use App\Modules\Accounts\Models\Type;
use App\Modules\Currencies\Models\Currency;
use App\Rules\ExistsMultipleColumns;
use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        //
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'type_id' => 'required|integer|exists:'.app(Type::class)->getTable().",id",
            'currency_id' => [
                'required',
                new ExistsMultipleColumns(app(Currency::class)->getTable(), 'id', 'code'),
            ],
            'opening_date' => 'sometimes|nullable|date',
            'starting_balance' => 'sometimes|nullable|numeric',
            'notes' => 'sometimes|nullable|string',
        ];
    }
}

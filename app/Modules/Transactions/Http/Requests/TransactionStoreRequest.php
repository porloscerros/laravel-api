<?php

namespace App\Modules\Transactions\Http\Requests;

use App\Modules\Transactions\Models\Type;
use App\Modules\Currencies\Models\Currency;
use App\Rules\ExistsMultipleColumns;
use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
//        return $this->user()->can('create', Movement::class);
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => 1//Auth::id(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'date' => 'required|date',
            'name' => 'required|string',
            'amount' => 'required|integer',
            'description' => 'sometimes|nullable|string',
            'type_id' => [
                'required',
                new ExistsMultipleColumns(app(Type::class)->getTable(), 'id', 'keyname'),
            ],
            'currency_id' => [
                'required',
                new ExistsMultipleColumns(app(Currency::class)->getTable(), 'id', 'keyname'),
            ],
        ];
    }

    /**
     * Get the validated data from the request.
     */
    public function validated(string|null $key = null, mixed $default = null): mixed
    {
        $data = data_get($this->validator->validated(), $key, $default);
        if (!is_numeric($data['type_id'])) {
            $data['type_id'] = Type::where('keyname', $this->type_id)
                ->select('id')
                ->first()->id;
        }
        if (!is_numeric($data['currency_id'])) {
            $data['currency_id'] = Currency::where('keyname', $this->currency_id)
                ->select('id')
                ->first()->id;
        }
        return $data;
    }
}

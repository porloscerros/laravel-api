<?php

namespace App\Modules\Transactions\Http\Requests;

use App\Modules\Transactions\Models\Type;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TransactionImportRequest extends FormRequest
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
        $this->collect($this->data)->each(function($item, $key) {
//            $this->merge([
//                "data.{$key}.account" => 1,
//            ]);
            $item['account'] = 1;
            $this->merge([
                'data' => [
                    $key => $item
                ],
            ]);
        });
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'data' => 'required|array|min:1',
            'data.*.date' => 'required|date',
            'data.*.name' => 'required|string',
            'data.*.income' => 'nullable|integer',
            'data.*.expense' => 'nullable|integer',
            'data.*.account' => 'required|integer|exists:accounts,id',
            'data.*.currency_rate' => 'required|numeric',
            'data.*.description' => 'nullable|string',
        ];
    }

    /**
     * Get the validated data from the request.
     */
    public function validated(string|null $key = null, mixed $default = null): mixed
    {
        $validated = data_get($this->validator->validated(), $key, $default)['data'];
        $user_id = 1;//Auth::id()
        $types = Type::all();
        $data = [];
        foreach ($validated as $key => $value) {
            $data[$key]['user_id'] = $user_id;//Auth::id()
            $data[$key]['account_id'] = $value['account'];
            $data[$key]['type_id'] = array_key_exists('income', $value) && $value['income']
                ? $types->where('keyname', 'income')->first()->id
                : $types->where('keyname', 'expense')->first()->id;
            $data[$key]['date'] = Carbon::parse($value['date']);
            $data[$key]['name'] = $value['name'];
            $data[$key]['amount'] = $value['income'] ?? $value['expense'];
            $data[$key]['currency_rate'] = $value['currency_rate'];
            $data[$key]['description'] = $value['description'];
        }
        return $data;
    }
}

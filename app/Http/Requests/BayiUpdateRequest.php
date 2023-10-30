<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BayiUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'max:200'],
            'berat_badan' => ['required'],
            'tinggi_badan' => ['required'],
            'golongan_darah' => ['required',  Rule::in(['A -/+', 'B -/+', 'O -/+', 'AB -/+'])]
        ];
    }

}

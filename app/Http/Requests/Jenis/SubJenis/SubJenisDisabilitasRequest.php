<?php

namespace App\Http\Requests\Jenis\SubJenis;

use Illuminate\Foundation\Http\FormRequest;

class SubJenisDisabilitasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_sub_jenis' => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ];
    }
}

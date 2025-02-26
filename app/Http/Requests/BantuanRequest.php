<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BantuanRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $this->merge([
            'nominal' => $this->nominal ? str_replace('.', '', $this->nominal) : null
        ]);
    }


    public function rules(): array
    {
        return [
            'disabilitas_id' => 'required|exists:data_disabilitas,id',
            'jenis_bantuan' => 'required|string|max:255',
            'type_bantuan' => 'required|in:tunai,barang',
            'nominal' => 'nullable|numeric|required_if:type_bantuan,tunai',
            'nama_barang' => 'nullable|string|max:255|required_if:type_bantuan,barang',
            'jumlah_barang' => 'nullable|integer|min:1|required_if:type_bantuan,barang',
            'deskripsi' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'disabilitas_id.required' => 'Disabilitas wajib dipilih.',
            'disabilitas_id.exists' => 'Data disabilitas tidak valid.',
            'jenis_bantuan.required' => 'Jenis bantuan wajib diisi.',
            'type_bantuan.required' => 'Tipe bantuan wajib dipilih.',
            'nominal.required_if' => 'Nominal harus diisi jika tipe bantuan adalah tunai.',
            'nama_barang.required_if' => 'Nama barang harus diisi jika tipe bantuan adalah barang.',
            'jumlah_barang.required_if' => 'Jumlah barang harus diisi jika tipe bantuan adalah barang.',
        ];
    }
}

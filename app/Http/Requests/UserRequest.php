<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nama_lengkap' => 'required|string|max:50',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('users'))],
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:6';
            $rules['role'] = 'required|in:adminpusat,petugasdesa,verifikator,kadis';
        } elseif ($this->isMethod('put') && $this->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        if ($this->isMethod('post') && $this->role === 'verifikator') {
            $rules['jabatan'] = 'required|string|max:100';
            $rules['desa_id'] = 'required|array|min:1';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 50 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan.',

            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role tidak valid.',

            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 6 karakter.',

            'jabatan.required' => 'Jabatan wajib diisi untuk verifikator.',
            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan maksimal 100 karakter.',

            'desa_id.required' => 'Minimal satu desa harus dipilih.',
            'desa_id.array' => 'Format desa tidak valid.',
            'desa_id.min' => 'Pilih minimal satu desa.',
        ];
    }
}

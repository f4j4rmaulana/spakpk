<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class JenisUjikomRequest extends FormRequest
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
        $rules = [
            'nama' => [
                'required',
                'min:5',
                'unique:jenis_ujikoms,nama',
            ],
            'deskripsi' => 'required',
        ];

        if ($this->getMethod() === 'PUT') {
            // dd($this->route()); lihat parameter id jenis_ujikom
            // dd($this->route('jenis_ujikom'));

            $jenisUjikom = Crypt::decryptString($this->route('jenis_ujikom'));

            $rules = [
                'nama' => [
                    'required',
                    'min:5',
                    Rule::unique('jenis_ujikoms', 'nama')->ignore($jenisUjikom, 'id'),
                ],
                'deskripsi' => 'required',
            ];
        }

        return $rules;
    }
}

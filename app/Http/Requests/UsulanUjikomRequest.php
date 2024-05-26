<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsulanUjikomRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'jenis_ujikom_id' => ['required', 'exists:jenis_ujikoms,id'],
            'ujikom_id' => ['required', 'exists:ujikoms,id'],
        ];

        if ($this->getMethod() === 'PUT') {

            $rules = [
                // 'user_id' => ['required','exists:users,id'],
                'jenis_ujikom_id' => ['required', 'exists:jenis_ujikoms,id'],
                'ujikom_id' => ['required', 'exists:ujikoms,id'],
            ];
        }

        return $rules;
    }
}

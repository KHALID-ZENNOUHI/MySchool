<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFormateurRequest extends FormRequest
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
        $teacherID = $this->route('teacher');
        return [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('formateurs')->ignore($teacherID)],
            'telephone' => ['required', 'string', 'max:255', Rule::unique('formateurs')->ignore($teacherID)],
            'adresse' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'date'],
            'sexe' => ['required', 'string', 'in:homme,femme'],
            'photo' => ['image', 'mimes:jpeg,png,jpg,svg'],
        ];
    }
}

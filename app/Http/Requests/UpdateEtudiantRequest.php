<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEtudiantRequest extends FormRequest
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
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email_student' => ['required', 'string', 'email', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'date'], // Assuming date format is expected
            'lieu_naissance' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'in:homme,femme'], // Enum values: homme or femme
            'photo' => ['image', 'mimes:jpeg,png,jpg,svg'],
            'classe_id' => ['required', 'exists:classes,id'],
            'nom_responsable' => ['required', 'string', 'max:255'],
            'prenom_responsable' => ['required', 'string', 'max:255'],
            'cin' => ['required', 'string', 'max:255'],
            'telephone_responsable' => ['required', 'string', 'max:255', 'nullable'],        
            'adresse_responsable' => ['required', 'string', 'max:255'],
            'sexe_responsable' => ['required', 'string', 'in:homme,femme'], // Enum values: homme or femme
            // 'username' => ['required', 'string', 'max:255', 'unique:users'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8'],
        ];
    }
}

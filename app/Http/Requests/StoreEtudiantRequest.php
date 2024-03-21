<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEtudiantRequest extends FormRequest
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
            'email_student' => ['required', 'string', 'email', 'max:255', 'unique:etudiants,email'],
            'telephone' => ['required', 'string', 'max:255', 'unique:etudiants,telephone'],
            'adresse' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'string', 'max:255'],
            'lieu_naissance' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image'],
            'classe_id' => ['required', 'exists:classes,id'],
            'nom_responsable' => ['required', 'string', 'max:255'],
            'prenom_responsable' => ['required', 'string', 'max:255'],
            'cin' => ['required', 'string', 'max:255', 'unique:responsables'],
            'telephone_responsable' => ['required', 'string', 'max:255', 'nullable', 'unique:responsables,telephone'],        
            'adresse_responsable' => ['required', 'string', 'max:255'],
            'sexe_responsable' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}

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
            'date_naissance' => ['required', 'date'],
            'lieu_naissance' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'in:homme,femme'], 
            'email_student' => ['required', 'string', 'email', 'max:255', 'unique:etudiants,email'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required','nullable', 'string', 'max:255', 'unique:etudiants,telephone'],
            'adresse' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,svg'],
            'classe_id' => ['required', 'exists:classes,id'],
            'nom_responsable' => ['required', 'string', 'max:255'],
            'prenom_responsable' => ['required', 'string', 'max:255'],
            'cin' => ['required', 'string', 'max:255'],
            'telephone_responsable' => ['required', 'string', 'max:255', 'nullable'],        
            'adresse_responsable' => ['required', 'string', 'max:255'],
            'sexe_responsable' => ['required', 'string', 'in:homme,femme'], 
        ];
    }
        
}

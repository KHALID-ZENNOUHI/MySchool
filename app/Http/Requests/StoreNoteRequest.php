<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
        // dd($this->all());
        return [
            'etudiant_id' => 'required|exists:etudiants,id',
            // 'matiere_id' => 'required|exists:matieres,id',
            'activite_id' => 'required|exists:activites,id',
            'note' => 'required|numeric|max:20|min:0',
            'classe_id' => 'required|exists:classes,id',
        ];
    }
}

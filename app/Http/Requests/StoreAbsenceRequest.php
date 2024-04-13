<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsenceRequest extends FormRequest
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
            'etudiant_id' => 'required|integer|exists:etudiants,id', 
            'date' => 'required|date_format:Y-m-d', 
            'duree' => 'required|in:journee,demi_journee,retard',
            'remarques' => 'nullable|string', 
            'justification' => 'boolean', 
        ];
    }
}

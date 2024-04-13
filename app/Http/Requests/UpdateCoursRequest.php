<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoursRequest extends FormRequest
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
            'jours' => 'required|integer',
            'start_datetime' => 'required|date_format:Y-m-d H:i',
            'end_datetime' => 'required|date_format:Y-m-d H:i|after:start_datetime',
            'matiere_id' => 'required|exists:matieres,id',
            'formateur_id' => 'required|exists:formateurs,id',
            'classe_id' => 'required|exists:classes,id',
            'color' => 'required|string',
        ];
    }
}

<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreActiviteRequest extends FormRequest
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
            'type' => ['required', 'in:exercice,avis,exam'],
            'title' => ['required', 'string', 'max:255'],
            'matiere_id' => ['nullable', 'exists:matieres,id'],
            'date' => ['required', 'date_format:Y-m-d\TH:i','after:now'],
            'ressources' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'max:1000'],
            'classe_id' => ['required', 'exists:classes,id'],
        ];
    }
}

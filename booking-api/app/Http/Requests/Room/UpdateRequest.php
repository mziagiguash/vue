<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'description' => 'string|max:500',
            'file' => 'image|mimes:jpeg,png,jpg,webp|max:512',
            'facility_id' => 'nullable|string|exists:facilities,id',
            'floor_area' => 'required|numeric|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            'type' => 'required|string|max:100',
            'price' => 'required|integer'
        ];
    }
}

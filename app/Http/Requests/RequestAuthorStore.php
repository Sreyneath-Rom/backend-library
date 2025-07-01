<?php

namespace App\Http\Requests;
use App\Http\Requests\DefaultRequest;


class RequestAuthorStore extends DefaultRequest
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
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'birthday' => ['required', 'date'],
            'nationality' => ['required', 'string','min:2', 'max:100'],
        ];
    }
}
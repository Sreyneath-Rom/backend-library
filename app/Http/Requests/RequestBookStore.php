<?php

namespace App\Http\Requests;

use App\Http\Requests\DefaultRequest;


class RequestBookStore extends DefaultRequest
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
            'title' => ['required', 'string', 'min:2', 'max:100'],
            'author_id' => 'required|exists:authors,id',
            'publish_date' => 'required|date',
            'description' => ['required', 'string', 'min:2', 'max:225'],
            'category_ids' => ['array', 'exists:categories,id'],
        ];
    }
}
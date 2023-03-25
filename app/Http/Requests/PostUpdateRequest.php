<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:5', 'max:255'],
            // 'slug' => ['required', 'min:5', 'max:255', 'unique:posts,slug,' . $this->id],
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            'status' => ['required'],
            'description' => ['required', 'min:10'],
            // 'photo' => ['required'],
            'tag_ids' => ['required'],
        ];
    }
}

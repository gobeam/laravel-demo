<?php

namespace App\Http\Requests;

use App\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;

class BlogRequestValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $blog = Blog::findOrNew(Request::get('id'));
        return Gate::allows('create', $blog) || Gate::allows('update', $blog);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255|unique:blogs,title,' . Request::get('id'),
            'description' => 'required',
            'category_id' => 'required',
            'body' => 'required|min:255',
            'image' => 'nullable|image',
            'status' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            "category_id.required" => "Category is required"
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     * @return array
     */
    public function rules()
    {
        return [
			'title' => 'required|min:5|max:' . config('validation.docs_title_max'),
			'text' => 'required|min:50|max:' . config('validation.docs_text_max')
        ];
	}

    /**
     * Get the validation messages
     * @return array
     */
    public function messages()
    {
        return [
			'title.required' => trans('documents.title_required'),
			'title.min' => trans('documents.title_min'),
			'title.max' => trans('documents.title_max'),
			'text.required' => trans('documents.text_required'),
			'text.min' => trans('documents.text_min'),
			'text.max' => trans('documents.text_max')
        ];
    }
}

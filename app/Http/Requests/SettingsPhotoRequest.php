<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsPhotoRequest extends FormRequest
{
    // Determine if the user is authorized to make this request.
    public function authorize()
    {
        return true;
    }

    // Get the validation rules that apply to the request.
    public function rules()
    {
        return [
            'image' => 'image|nullable|max:1999'
        ];
	}
	
	// Get the validation messages that apply to the request.
	public function messages() {
		return [
			'image.image'       => trans('my_valid.settings_image_image'),
			'image.max'  		=> trans('my_valid.settings_image_max'),
			'image.uploaded' 	=> trans('my_valid.settings_image_uploaded'),
		];
	}
}

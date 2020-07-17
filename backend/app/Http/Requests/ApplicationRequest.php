<?php

namespace App\Http\Requests;

use App\Models\TrApplication;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'application_name' => 'required|max:32',
            'application_url' => 'required|url',
            'tags' => 'required|max:200',
            'application_concept' => 'required|max:64',
            'application_upload_image.*' => 'image|max:2048',
            'image_delete.*' => 'in:1,2,3',
            'application_type' => 'required|in:'.implode(',', array_keys(TrApplication::APPLICATION_TYPE)),
            'application_overview' => 'required|max:200',
            'used_technology' => 'required|max:200',
            'pr_message' => 'present|max:200',
            'additional_features' => 'present|max:200',
            'other_message' => 'present|max:200',

        ];
    }
}

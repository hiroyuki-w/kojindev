<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'user_name' => 'required|max:32',
            'user_profile' => 'required|max:500',
            'user_skillset' => 'required|max:500',
            'git_account' => 'present|max:30',
            'twitter_account' => 'present|max:30',
            'my_url' => 'present|max:200',
            'profile_upload_image' => 'image|max:2048',
            'delete_image' => 'in:1',

        ];
    }
}

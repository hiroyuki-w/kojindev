<?php

namespace App\Http\Requests;

use App\Models\TrApplicationReport;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'report_type' => 'required|in:'.implode(',', array_keys(TrApplicationReport::REPORT_TYPE)),
            'report_title' => 'required|max:15',
            'report_text' => 'required|max:200',
        ];
    }
}

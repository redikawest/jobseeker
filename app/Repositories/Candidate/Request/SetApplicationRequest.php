<?php

namespace App\Repositories\Candidate\Request;

use Illuminate\Foundation\Http\FormRequest;

class SetApplicationRequest extends FormRequest
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
            'candidate_id'  => 'required|integer',
            'vacancy_id'    => 'required|integer',
        ];
    }
}

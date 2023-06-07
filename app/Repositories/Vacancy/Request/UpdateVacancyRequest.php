<?php

namespace App\Repositories\Vacancy\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacancyRequest extends FormRequest
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
            'vacancy_name'  => 'required|string',
            'min_age'       => 'required|integer',
            'max_age'       => 'required|integer',
            'expired_date'  => 'required',
            'requirement_gender'    => 'required|in:Male,Female,All,male,female, all'
        ];
    }
}

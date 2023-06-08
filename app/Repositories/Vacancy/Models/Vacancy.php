<?php

namespace App\Repositories\Vacancy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vacancies';
    protected $guarded = [];

    /**
     * 
     * Function
     * 
     */

    public function scopeFilter($query, $request)
    {
        return $query->where(function ($query) use ($request) {

            if ($request->has('gender') && $request->gender != '') {
                $query->where('requirement_gender', $request->gender);
            }

            if ($request->has('min_age') && $request->min_age != '') {
                $min_age = (int) $request->min_age;
                $query->where('min_age', ">=", "$min_age");
            }

            if ($request->has('max_age') && $request->max_age != '') {
                $max_age = (int) $request->max_age;
                $query->where('max_age', "<=", "$max_age");
            }

            if ($request->has('search') && strlen($request->search) > 1) {
                $query->where(function ($search) use ($request) {
                    $search->where("vacancy_name", "LIKE", "%$request->search%");
                });
            }
        })
        ->select('id', 'vacancy_name', 'min_age', 'max_age', 'requirement_gender', 'expired_date', 'created_at');
    }

    public function scopeName($query, $name)
    {
        return $query->where('vacancy_name', $name);
    }
}

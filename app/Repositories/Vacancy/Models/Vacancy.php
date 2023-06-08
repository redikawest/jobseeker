<?php

namespace App\Repositories\Vacancy\Models;

use App\Repositories\Candidate\Models\Candidate;
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
     * Getter
     * 
     */
    public function getVacancyNameAttribute()
    {
        return $this->attributes['vacancy_name'];
    }

    public function getMinAgeAttribute()
    {
        return $this->attributes['min_age'];
    }

    public function getMaxAgeAttribute()
    {
        return $this->attributes['max_age'];
    }

    public function getRequirementGenderAttribute()
    {
        return $this->attributes['requirement_gender'];
    }

    public function getExpiredDateAttribute()
    {
        return $this->attributes['expired_date'];
    }

    /**
     * 
     * Setter
     * 
     */

    public function setVacancyNameAttribute($value)
    {
        return $this->attributes['vacancy_name'] = $value;
    }

    public function setMinAgeAttribute($value)
    {
        return $this->attributes['min_age'] = $value;
    }

    public function setMaxAgeAttribute($value)
    {
        return $this->attributes['max_age'] = $value;
    }

    public function setRequirementGenderAttribute($value)
    {
        return $this->attributes['requirement_gender'] = $value;
    }

    public function setExpiredDateAttribute($value)
    {
        return $this->attributes['expired_date'] = $value;
    }

    /**
     * 
     * Relationship
     * 
     */

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_applies', 'vacancy_id', 'candidate_id');
    }

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

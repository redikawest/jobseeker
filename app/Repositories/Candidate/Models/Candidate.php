<?php

namespace App\Repositories\Candidate\Models;

use App\Repositories\Vacancy\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'candidates';
    protected $guarded = [];

    /**
     * 
     * Getter
     * 
     */
    public function getFullNameAttribute()
    {
        return $this->attributes['full_name'];
    }

    public function getDobAttribute()
    {
        return $this->attributes['dob'];
    }

    public function getGenderAttribute()
    {
        return $this->attributes['gender'];
    }

    /**
     * 
     * Setter
     * 
     */
    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = $value;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value;
    }

    public function setGenderAttribute($value)
    {
        $this->attributes['gender'] = $value;
    }

    /**
     * 
     * Relationship
     * 
     */

    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class, 'candidate_applies', 'candidate_id', 'vacancy_id');
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
                $query->where('gender', $request->gender);
            }

            if ($request->has('search') && strlen($request->search) > 1) {
                $query->where(function ($search) use ($request) {
                    $search->where("full_name", "LIKE", "%$request->search%");
                });
            }
        })
        ->select('id', 'full_name', 'dob', 'gender');
    }

    public function scopeName($query, $name)
    {
        return $query->where('full_name', $name);
    }
}

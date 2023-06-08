<?php

namespace App\Repositories\Candidate\Models;

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

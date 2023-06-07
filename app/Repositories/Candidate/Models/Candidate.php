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

    /**
     * 
     * Function
     * 
     */

    public function scopeFilter($query, $request)
    {
        return $query->where(function ($query) use ($request) {

            if ($request->has('search') && strlen($request->search) > 1) {
                $query->where(function ($search) use ($request) {
                    $search->where("full_name", "LIKE", "%$request->search%")
                        ->orWhere("dob", "LIKE", "%$request->search%")
                        ->orWhere("gender", "LIKE", "%$request->search%");
                });

            }
        });
    }

    public function scopeId($query, $request)
    {
        
    }
}

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

            if ($request->has('partner') && $request->partner != '') {
                $query->where('partnerId', $request->partner);
            }

            if ($request->has('account') && $request->account != '') {
                $query->where('accountId', $request->account);
            }

            if ($request->has('gender') && $request->gender != '') {
                $query->where('gender', $request->gender);
            }

            if ($request->has('device') && $request->device != '') {
                $query->where('deviceData', 'LIKE', "%$request->device%");
            }

            if ($request->has('fromAge') && $request->fromAge != '') {
                $query->whereBetween('age', [$request->fromAge, $request->toAge]);
            }

            if ($request->has('isSubscribe') && $request->isSubscribe != '') {
                $query->where('isTickBox', true);
            }

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

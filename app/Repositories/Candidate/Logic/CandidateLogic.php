<?php

namespace App\Repositories\Candidate\Logic;

use App\Repositories\Candidate\Interface\CandidateInterface;
use App\Repositories\Candidate\Models\Candidate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CandidateLogic implements CandidateInterface
{
    public function getAll(Request $request)
    {
        $data = Candidate::filter($request)->get();
        if (!$data || count($data) == 0) {
            return response(['message' => 'Candidate Data Not Found'], 404);
        }
            
        return response()->json([
            'data'  => $data
        ]);
    }

    public function create(Request $request)
    {
        try {

            $candidate = Candidate::Name($request->full_name)->first();
            if ($candidate) {
                return response([ 'message' => 'Duplicate Candidate'], 409);
            }

            $this->saveCandidate($request);

            return response(['message' => 'Success Create Data Candidate'], 200);

        } catch (Exception $exception) {
            Log::error($exception);
            return $exception;
        }
    }

    public function update($candidateId, Request $request)
    {
        try {

            $data = Candidate::find($candidateId);
            if (!$data) {
                return response(['message' => 'Candidate Data Not Found'], 404);
            }

            $candidate = Candidate::Name($request->full_name)->first();
            if ($candidate) {
                return response([ 'message' => 'Duplicate Candidate'], 409);
            }

            $data->update([
                'full_name' => $request->full_name,
                'dob'       => $request->dob,
                'gender'    => $request->gender
            ]);

            return response(['message' => 'Success Update Data Candidate'], 200);

        } catch (Exception $exception) {
            Log::error($exception);
            return $exception;
        }
    }

    public function delete($candidateId)
    {
        try {

            $data = Candidate::find($candidateId);
            if (!$data) {
                return response(['message' => 'Candidate Data Not Found'], 404);
            }

            $data->delete();

            return response(['message' => 'Success Delete Data Candidate'], 200);

        } catch (Exception $exception) {
            Log::error($exception);
            return $exception;
        }
    }

    /**
     * 
     * Private Function
     * 
     */

    private function saveCandidate(Request $request)
    {
        return Candidate::create([
            'full_name' => $request->full_name,
            'dob'       => $request->dob,
            'gender'    => $request->gender
        ]);
    }
}
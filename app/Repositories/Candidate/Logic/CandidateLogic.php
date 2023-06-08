<?php

namespace App\Repositories\Candidate\Logic;

use App\Repositories\Candidate\Interface\CandidateInterface;
use App\Repositories\Candidate\Models\Candidate;
use App\Repositories\Candidate\Models\CandidateApplication;
use App\Repositories\Vacancy\Models\Vacancy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CandidateLogic implements CandidateInterface
{
    public function getAll(Request $request)
    {
        $sortBy = $request->sort_by ? $request->sort_by : 'id';
        $orderBy = $request->order_by ? $request->order_by : 'asc';

        $data = Candidate::filter($request)->orderBy($sortBy, $orderBy)->get();
        if (!$data || count($data) == 0) {
            return response(['message' => 'Candidate Data Not Found'], 404);
        }
        
        return response()->json([
            'data'  => $this->parserCollections($data)
        ]);
    }

    public function create(Request $request)
    {
        try {

            $candidate = Candidate::Name($request->full_name)->first();
            if ($candidate) {
                return response([ 'message' => 'Duplicate Candidate'], 409);
            }

            $data = new Candidate();
            $data->full_name = $request->full_name;
            $data->gender = $request->gender;
            $data->dob = $request->dob;
            $data->save();
            // $this->saveCandidate($request);

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

            $data->full_name = $request->full_name;
            $data->gender = $request->gender;
            $data->dob = $request->dob;
            $data->save();

            // $data->update([
            //     'full_name' => $request->full_name,
            //     'dob'       => $request->dob,
            //     'gender'    => $request->gender
            // ]);

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

    public function setApplication(Request $request)
    {
        try {

            $candidate = Candidate::find($request->candidate_id);
            if (!$candidate) {
                return response(['message' => 'Candidate Data Not Found'], 404);
            }

            $vacancy = Vacancy::find($request->vacancy_id);
            if (!$vacancy) {
                return response(['message' => 'Vacancy Data Not Found'], 404);
            }
            
            $this->saveApplication($request);

            return response(['message' => 'Success Apply Vacancy'], 200);

        } catch(Exception $exception) {
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

    private function saveApplication(Request $request)
    {
        return CandidateApplication::create([
            'candidate_id'  => $request->candidate_id,
            'vacancy_id'    => $request->vacancy_id,
            'apply_date'    => now()
        ]);
    }

    private function parserCollections($collections)
    {
        $results = [];
        foreach($collections as $data) {
            $results[] = $this->parserData($data);
        }

        return $results;
    }

    private function parserData($data)
    {
        if (!$data) {
            return null;
        }

        return [
            'id'    => $data->id,
            'full_name' => $data->full_name,
            'dob'       => $data->dob,
            'gender'    => $data->gender,
            'applied_job'   => $this->parserApplication($data->vacancies)
        ];
    }

    private function parserApplication($collections)
    {
        $results = [];
        foreach($collections as $data) {
            $results[] = [
                'vacancy_name'  => $data->vacancy_name,
                'expired_date'    => $data->expired_date
            ];
        }

        return $results;
    }
}
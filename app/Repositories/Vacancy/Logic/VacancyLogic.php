<?php

namespace App\Repositories\Vacancy\Logic;

use App\Repositories\Vacancy\Interface\VacancyInterface;
use App\Repositories\Vacancy\Models\Vacancy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VacancyLogic implements VacancyInterface
{
    public function getAll(Request $request)
    {
        $sortBy = $request->sort_by ? $request->sort_by : 'id';
        $orderBy = $request->order_by ? $request->order_by : 'asc';

        $data = Vacancy::filter($request)->orderBy($sortBy, $orderBy)->get();
        if (!$data || count($data) == 0) {
            return response(['message' => 'Vacancy Data Not Found'], 404);
        }
            
        return response()->json([
            'data'  => $data
        ]);
    }

    public function create(Request $request)
    {
        try {

            $vacancy = Vacancy::Name($request->vacancy_name)->first();
            if ($vacancy) {
                return response([ 'message' => 'Duplicate Vacancy'], 409);
            }

            $data = new Vacancy();
            $data->vacancy_name = $request->vacancy_name;
            $data->min_age = $request->min_age;
            $data->max_age = $request->max_age;
            $data->requirement_gender = $request->requirement_gender;
            $data->expired_date = $request->expired_date;
            $data->save();

            // $this->saveVacancy($request);

            return response(['message' => 'Success Create Data Vacancy'], 200);

        } catch(Exception $exception) {
            Log::error($exception);
            return $exception;
        }
    }

    public function update($vacancyId, Request $request)
    {
        try {

            $data = Vacancy::find($vacancyId);
            if (!$data) {
                return response(['message' => 'Vacancy Data Not Found'], 404);
            }

            $vacancy = Vacancy::Name($request->vacancy_name)->first();
            if ($vacancy) {
                return response([ 'message' => 'Duplicate Vacancy'], 409);
            }

            $data->vacancy_name = $request->vacancy_name;
            $data->min_age = $request->min_age;
            $data->max_age = $request->max_age;
            $data->requirement_gender = $request->requirement_gender;
            $data->expired_date = $request->expired_date;
            $data->save();

            // $this->updateVacancy($request, $data);

            return response(['message' => 'Success Update Data Vacancy'], 200);

        } catch(Exception $exception) {
            Log::error($exception);
            return $exception;
        }
    }

    public function delete($vacancyId)
    {
        try {

            $data = Vacancy::find($vacancyId);
            if (!$data) {
                return response(['message' => 'Vacancy Data Not Found'], 404);
            }

            $data->delete();

            return response([
                'message' => 'Success Delete Data Vacancy'
            ], 200);

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

    private function saveVacancy(Request $request)
    {
        return Vacancy::create([
            'vacancy_name'  => $request->vacancy_name,
            'min_age'       => $request->min_age,
            'max_age'       => $request->max_age,
            'requirement_gender'    => $request->requirement_gender,
            'expired_date'  => $request->expired_date
        ]);
    }

    private function updateVacancy(Request $request, $vacancy)
    {
        return $vacancy->update([
            'vacancy_name'  => $request->vacancy_name,
            'min_age'       => $request->min_age,
            'max_age'       => $request->max_age,
            'requirement_gender'    => $request->requirement_gender,
            'expired_date'  => $request->expired_date
        ]);
    }
}
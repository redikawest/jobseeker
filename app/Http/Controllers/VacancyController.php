<?php

namespace App\Http\Controllers;

use App\Repositories\Vacancy\Logic\VacancyLogic;
use App\Repositories\Vacancy\Request\CreateVacancyRequest;
use App\Repositories\Vacancy\Request\UpdateVacancyRequest;
use Illuminate\Http\Request;

class VacancyController extends Controller
{

    private $vacancyLogic;

    public function __construct(VacancyLogic $vacancyLogic)
    {
        return $this->vacancyLogic = $vacancyLogic;
    }

    public function getAll(Request $request)
    {
        return $this->vacancyLogic->getAll($request);
    }

    public function create(CreateVacancyRequest $request)
    {
        return $this->vacancyLogic->create($request);
    }

    public function update($vacancyId, UpdateVacancyRequest $request)
    {
        return $this->vacancyLogic->update($vacancyId, $request);
    }

    public function delete($vacancyId)
    {
        return $this->vacancyLogic->delete($vacancyId);
    }
}
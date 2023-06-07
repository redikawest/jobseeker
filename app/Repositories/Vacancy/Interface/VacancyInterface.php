<?php

namespace App\Repositories\Vacancy\Interface;

use Illuminate\Http\Request;

interface VacancyInterface {
    
    public function getAll(Request $request);
    public function create(Request $request);
    public function update($vacancyId, Request $request);
    public function delete($vacancyId);
}
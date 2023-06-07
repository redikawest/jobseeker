<?php

namespace App\Repositories\Candidate\Interface;

use Illuminate\Http\Request;

interface CandidateInterface {

    public function getAll(Request $request);
    public function create(Request $request);
    public function update($candidateId, Request $request);
    public function delete($candidateId);
}
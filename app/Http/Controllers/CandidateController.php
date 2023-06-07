<?php

namespace App\Http\Controllers;

use App\Repositories\Candidate\Logic\CandidateLogic;
use App\Repositories\Candidate\Request\CreateCandidateRequest;
use App\Repositories\Candidate\Request\UpdateCandidateRequest;
use Illuminate\Http\Request;

class CandidateController extends Controller
{

    private $candidateLogic;

    public function __construct(CandidateLogic $candidateLogic)
    {
        return $this->candidateLogic = $candidateLogic;
    }

    public function getAll(Request $request)
    {
        return $this->candidateLogic->getAll($request);
    }

    public function create(CreateCandidateRequest $request)
    {
        return $this->candidateLogic->create($request);
    }

    public function update($candidateId, UpdateCandidateRequest $request)
    {
        return $this->candidateLogic->update($candidateId, $request);
    }

    public function delete($candidateId)
    {
        return $this->candidateLogic->delete($candidateId);
    }
}
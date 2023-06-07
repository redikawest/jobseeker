<?php

namespace App\Http\Controllers;

use App\Repositories\Candidate\Logic\CandidateLogic;
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

    public function create(Request $request)
    {
        return $this->candidateLogic->create($request);
    }

    public function update($candidateId, Request $request)
    {
        return $this->candidateLogic->update($candidateId, $request);
    }

    public function delete($candidateId)
    {
        return $this->candidateLogic->delete($candidateId);
    }
}
<?php

namespace Database\Seeders;

use App\Repositories\Candidate\Models\CandidateApplication;
use Illuminate\Database\Seeder;

class AppliedCandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CandidateApplication::truncate();

        $data = [
            ['candidate_id' => 1, 'vacancy_id' => 1, 'apply_date' => '2001-04-11'],
            ['candidate_id' => 2, 'vacancy_id' => 2, 'apply_date' => '2001-04-11'],
        ];

        foreach ($data as $value) {
            CandidateApplication::create($value);
        }
    }
}

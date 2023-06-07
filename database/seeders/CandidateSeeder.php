<?php

namespace Database\Seeders;

use App\Repositories\Candidate\Models\Candidate;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::truncate();

        $data = [
            ['id' => 1,'full_name' => 'Fawaid Syamsul Arifin', 'dob' => '2001-04-11', 'gender' => 'Male', 'created_at' => now()],
            ['id' => 2,'full_name' => 'Agus Budi Purnomo', 'dob' => '1977-08-05', 'gender' => 'Male', 'created_at' => now()],
            ['id' => 3,'full_name' => 'Johan Lolong', 'dob' => '1968-01-09', 'gender' => 'Male', 'created_at' => now()],
            ['id' => 4,'full_name' => 'Faradilah Yunita', 'dob' => '1989-06-04', 'gender' => 'Female', 'created_at' => now()],
            ['id' => 5,'full_name' => 'Jimmy Bandi', 'dob' => '1978-10-29', 'gender' => 'Male', 'created_at' => now()],
            ['id' => 6,'full_name' => 'Janice Devina Tirtautama', 'dob' => '1991-06-07', 'gender' => 'Female', 'created_at' => now()],
            ['id' => 7,'full_name' => 'Rudy Rudy', 'dob' => '1989-03-07', 'gender' => 'Male', 'created_at' => now()],
            ['id' => 8,'full_name' => 'Jefri Yusuf', 'dob' => '1985-08-14', 'gender' => 'Male', 'created_at' => now()],
            ['id' => 9,'full_name' => 'Djarot Wakskita', 'dob' => '1972-03-05', 'gender' => 'Male', 'created_at' => now()],
            ['id' => 10,'full_name' => 'Diah Permata', 'dob' => '1973-12-23', 'gender' => 'Female', 'created_at' => now()],
        ];

        foreach ($data as $value) {
            Candidate::create($value);
        }
    }
}

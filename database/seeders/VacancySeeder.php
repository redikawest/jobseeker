<?php

namespace Database\Seeders;

use App\Repositories\Vacancy\Models\Vacancy;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vacancy::truncate();

        $data = [
            ['id' => 1, 'vacancy_name' => 'UI/UX Designer (UI/UX Desain)', 'min_age' => 0, 'max_age' => 0, 'requirement_gender' => 'Male', 'created_at' => '2023-04-29 15:14:45', 'expired_date' => '2023-06-28'],
            ['id' => 2, 'vacancy_name' => 'Mobile Apps Development Manager', 'min_age' => 27, 'max_age' => 35, 'requirement_gender' => 'All', 'created_at' => '2023-04-17 16:54:44', 'expired_date' => '2023-06-16'],
            ['id' => 3, 'vacancy_name' => 'Translater (Penterjemah)', 'min_age' => 25, 'max_age' => 40, 'requirement_gender' => 'Female', 'created_at' => '2023-04-05 09:35:54', 'expired_date' => '2023-06-04'],
            ['id' => 4, 'vacancy_name' => 'Food and Beverage Barista (Barista)', 'min_age' => 20, 'max_age' => 0, 'requirement_gender' => 'Female', 'created_at' => '2023-03-30 15:13:34', 'expired_date' => '2023-05-29'],
            ['id' => 5, 'vacancy_name' => 'Admin Staff', 'min_age' => 19, 'max_age' => 25, 'requirement_gender' => 'All', 'created_at' => '2023-03-12 20:45:45', 'expired_date' => '2023-05-11'],
            ['id' => 6, 'vacancy_name' => 'Administration (Administrasi, Admin)', 'min_age' => 17, 'max_age' => 35, 'requirement_gender' => 'Male', 'created_at' => '2023-03-01 09:50:35', 'expired_date' => '2023-04-30'],
            ['id' => 7, 'vacancy_name' => 'Account Officer', 'min_age' => 20, 'max_age' => 50, 'requirement_gender' => 'Male', 'created_at' => '2023-01-06 12:55:33', 'expired_date' => '2023-03-07'],
            ['id' => 8, 'vacancy_name' => 'Bellboy', 'min_age' => 40, 'max_age' => 50, 'requirement_gender' => 'Female', 'created_at' => '2023-01-04 08:17:37', 'expired_date' => '2023-03-05'],
            ['id' => 9, 'vacancy_name' => 'Store Crew', 'min_age' => 12, 'max_age' => 19, 'requirement_gender' => 'Male', 'created_at' => '2023-01-02 13:22:35', 'expired_date' => '2023-07-02'],
            ['id' => 10, 'vacancy_name' => 'Sekuitwot', 'min_age' => 40, 'max_age' => 30, 'requirement_gender' => 'Female', 'created_at' => '2023-01-02 08:46:51', 'expired_date' => '2023-07-16'],
        ];

        foreach ($data as $value) {
            Vacancy::create($value);
        }
    }
}

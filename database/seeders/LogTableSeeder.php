<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Log;

class LogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::create([
            'user'      => 'admin1',
            'message'   => 'a invite l\'employé “tttt” à joindre la société “Companytech” ',
            'date'      => '2023-05-04 13:12:34',
        ]);
        Log::create([
            'user'      => 'fatimazahra',
            'message'   => 'a validé l\'invitation ',
            'date'      => '2023-05-04 13:12:34',
        ]);
        Log::create([
            'user'      => 'Jack White',
            'message'   => ' a confirmer son profile',
            'date'      => '2023-08-12 13:12:34',
        ]);
        Log::create([
            'user'      => 'Jack White',
            'message'   => 'a confirmer son profile” ',
            'date'      => '2023-05-04 13:12:34',
        ]);
    }
}
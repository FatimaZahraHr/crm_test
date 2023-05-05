<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'       => 'admin1',
            'email'      => 'admin1@yopmail.com',
            'password'   => bcrypt('password'),
            'role'       => 1
        ]);
       User::create([
            'name'       => 'admin2',
            'email'      => 'admin2@yopmail.com',
            'password'   => bcrypt('password'),
            'role'       => 1
        ]);
        User::create([
            'name'       => 'mohamed Alaoui',
            'email'      => 'm.alaoui@yopmail.com',
            'password'   => bcrypt('password'),
            'role'       => 2,
            'id_company' => 1
        ]);
        User::create([
            'name'       => 'Fatima zahra HR',
            'email'      => 'f.hr@yopmail.com',
            'password'   => bcrypt('password'),
            'role'       => 2,
            'role'       => 1,
            'id_company' => 1
        ]);
        User::create([
            'name'       => 'Soukaina khalif',
            'email'      => 's.khalif@yopmail.com',
            'password'   => bcrypt('password'),
            'adress'     => 'hay farah',
            'tel'        => '0688998877',
            'birthday'   => '22/12/1997',
            'status'     => 2,
            'role'       => 2,
            'id_company' => 2
        ]);
        User::create([
            'name'       => 'Badr naim',
            'email'      => 'b.naim@yopmail.com',
            'password'   => bcrypt('password'),
            'role'       => 2,
            'id_company' => 2
        ]);
    }
}

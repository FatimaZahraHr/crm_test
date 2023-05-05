<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'nom'           => 'Companytech',
            'raison_social' => 'test1',
            'email'         => 'companytech@yopmail.com',
            'adresse'       => 'Hay Amal Rabat',
            'tel'           => '0688998877',
            'date_creation' => '12/12/2004',
            'description'   => 'Lorem ipsum dolor sit amet.
                                Et eveniet magni eos deleniti blanditiis eum porro
                                ipsa ut laborum dolores est recusandae natus.
                                Est similique molestiae qui numquam sint est
                                provident natus a voluptatem incidunt ut 
                                repudiandae voluptatem ut quis odio.',
            'id_admin'     => 1,   
        ]);
        Company::create([
            'nom'           => 'HarTech',
            'raison_social' => 'test2',
            'email'         => 'hartech@yopmail.com',
            'adresse'       => 'Hay salam Salé',
            'tel'           => '0688998877',
            'date_creation' => '05/02/2014',
            'description'   => 'Lorem ipsum dolor sit amet.
                                Et eveniet magni eos deleniti blanditiis eum porro
                                ipsa ut laborum dolores est recusandae natus.
                                Est similique molestiae qui numquam sint est
                                provident natus a voluptatem incidunt ut 
                                repudiandae voluptatem ut quis odio.',
            'id_admin'     => 1,  
        ]);
        Company::create([
            'nom'           => 'ITsarl',
            'raison_social' => 'test3',
            'email'         => 'itsarl@yopmail.com',
            'adresse'       => '28 Hay farah Rabat',
            'tel'           => '0688998877',
            'date_creation' => '10/12/2009',
            'description'   => 'Lorem ipsum dolor sit amet.
                                Et eveniet magni eos deleniti blanditiis eum porro
                                ipsa ut laborum dolores est recusandae natus.
                                Est similique molestiae qui numquam sint est
                                provident natus a voluptatem incidunt ut 
                                repudiandae voluptatem ut quis odio.',
            'id_admin'     => 1,  
        ]);
        Company::create([
            'nom'           => 'Terpacsarl',
            'raison_social' => 'test4',
            'email'         => 'Terpacsarl@yopmail.com',
            'adresse'       => 'Agdal Avenue france Rabat',
            'tel'           => '0688998877',
            'date_creation' => '04/01/2010',
            'description'   => 'Lorem ipsum dolor sit amet.
                                Et eveniet magni eos deleniti blanditiis eum porro
                                ipsa ut laborum dolores est recusandae natus.
                                Est similique molestiae qui numquam sint est
                                provident natus a voluptatem incidunt ut 
                                repudiandae voluptatem ut quis odio.',
            'id_admin'     => 1,  
        ]);
        Company::create([
            'nom'           => 'testSarl',
            'raison_social' => 'test5',
            'email'         => 'testSarl@yopmail.com',
            'adresse'       => 'Agdal Avenue farah Rabat',
            'tel'           => '0688998877',
            'date_creation' => '12/07/2010',
            'description'   => 'Lorem ipsum dolor sit amet.
                                Et eveniet magni eos deleniti blanditiis eum porro
                                ipsa ut laborum dolores est recusandae natus.
                                Est similique molestiae qui numquam sint est
                                provident natus a voluptatem incidunt ut 
                                repudiandae voluptatem ut quis odio.',
            'id_admin'     => 1,  
        ]);
        
    }
}

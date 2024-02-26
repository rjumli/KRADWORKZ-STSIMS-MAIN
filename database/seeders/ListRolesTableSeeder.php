<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_roles')->delete();
        
        \DB::table('list_roles')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Scholarship Coordinator',
                'description' => 'The highest user role defined in the system. The Scholarship Coordinator will have the privilege to review, monitor, and manage all scholarship transactions.',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Scholarship Staff',
                'description' => 'This user role is responsible for encoding and managing scholarship information in regional offices.',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'PSTO Staff',
                'description' => 'This user role is responsible for encoding and managing scholarship information in the provincial offices.',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'University Coordinator',
                'description' => 'This user role is responsible for encoding and managing scholarship information assigned within the University.',
                'is_active' => 1,
            ),
        ));
        
        
    }
}
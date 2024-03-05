<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \DB::table('users')->insert([
            'username' => 'administrator',
            'email' => 'kradjumli@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'Administrator',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        \DB::table('user_profiles')->insert([
            'firstname' => 'Ra-ouf',
            'lastname' => 'Jumli',
            'middlename' => 'Indanan',
            'gender' => 'Male',
            'user_id' => 1,
            'mobile' => '09171531652',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call(LocationRegionsTableSeeder::class);
        $this->call(LocationProvincesTableSeeder::class);
        $this->call(LocationMunicipalitiesTableSeeder::class);
        $this->call(LocationBarangaysTableSeeder::class);
        $this->call(ListDropdownsTableSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(ListMenusTableSeeder::class);
        $this->call(ListRolesTableSeeder::class);
        $this->call(ListCoursesTableSeeder::class);
        $this->call(SchoolsTableSeeder::class);
        $this->call(SchoolCampusesTableSeeder::class);
        $this->call(SchoolNamesTableSeeder::class);
        $this->call(ListAgenciesTableSeeder::class);
        $this->call(ListStatusesTableSeeder::class);
        $this->call(ListProgramsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserProfilesTableSeeder::class);
        $this->call(SchoolCoursesTableSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'administrator',
                'email' => 'kradjumli@gmail.com',
                'email_verified_at' => '2023-05-23 14:09:38',
                'password' => '$2y$10$YE9gqidGXvCjvezVRBvdUO5pUtro9zSQsSGrMXibYttTHMbg0p2Re',
                'role' => 'Administrator',
                'is_active' => 1,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:09:38',
                'updated_at' => '2023-05-23 14:09:38',
            ),
            1 => 
            array (
                'id' => 2,
                'username' => 'DOST-I',
                'email' => 'dost-i@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$GKvVPuJVq2HHpY88i/NxteBLSX9Ab3YN9O4SSGkeCx66U23fpDt5.',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:10:19',
                'updated_at' => '2023-05-23 14:10:19',
            ),
            2 => 
            array (
                'id' => 3,
                'username' => 'DOST-II',
                'email' => 'dost-ii@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$AEZ/Xm/9aFOkfVHJtILcheyksCAYSW4ZaWVSJI//7wmecd4Wu335K',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:12:10',
                'updated_at' => '2023-05-23 14:12:10',
            ),
            3 => 
            array (
                'id' => 4,
                'username' => 'DOST-III',
                'email' => 'dost-iii@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$jLD0dMu5i7oU/WtBInWofe12UeaDDsoJ76bho4qxUiRF2GcrmLSQy',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:12:17',
                'updated_at' => '2023-05-23 14:12:17',
            ),
            4 => 
            array (
                'id' => 5,
                'username' => 'DOST-IVA',
                'email' => 'dost-iva@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$n0FqPzINV.jfE7h87xP4R.MFGZSDisdmE5YO.cL15xN7OkIBiData',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:12:56',
                'updated_at' => '2023-05-23 14:12:56',
            ),
            5 => 
            array (
                'id' => 6,
                'username' => 'DOST-IVB',
                'email' => 'dost-ivb@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$/V2j9oWEWM9qAvcu1xIZlOrYi4v2X97BcF52zUMA3Va8oPGREuqMW',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:00',
                'updated_at' => '2023-05-23 14:13:00',
            ),
            6 => 
            array (
                'id' => 7,
                'username' => 'DOST-V',
                'email' => 'dost-v@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$k3ncm.RRKJH/0bFtFysLy.61ODzTjtwFXanSNtRlahtrGJ12M04ti',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:05',
                'updated_at' => '2023-05-23 14:13:05',
            ),
            7 => 
            array (
                'id' => 8,
                'username' => 'DOST-VI',
                'email' => 'dost-vi@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$o/7sVHc.gJWL5LgIz04mK.kAUIaZZ62eu/HCzkmEyedka4Wy1Az.m',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:09',
                'updated_at' => '2023-05-23 14:13:09',
            ),
            8 => 
            array (
                'id' => 9,
                'username' => 'DOST-VII',
                'email' => 'dost-vii@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$ISRSYR4begQd0f3NSBdh.evi.X51P9QlhxVzWoKcGBicnxCGoNdsu',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:17',
                'updated_at' => '2023-05-23 14:13:17',
            ),
            9 => 
            array (
                'id' => 10,
                'username' => 'DOST-VIII',
                'email' => 'dost-viii@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Esu1fsl4/SC9G2bJUb8PvOTEoFGNcv6NpTMCsZVPZCbYL94bAVx9a',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:22',
                'updated_at' => '2023-05-23 14:13:22',
            ),
            10 => 
            array (
                'id' => 11,
                'username' => 'DOST-IX',
                'email' => 'dost-ix@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$BHxPSMcV0X41Pq9mOAPvHOa/8/ipenwx3gQtL6ilIdfp3qXiwRgbC',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:26',
                'updated_at' => '2023-05-23 14:13:26',
            ),
            11 => 
            array (
                'id' => 12,
                'username' => 'DOST-X',
                'email' => 'dost-x@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$UZQVU6ezVPD4yGjWv9ojxOQKr8l/2X8rF3vJ/xSM6bcGgxk2xDA4a',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:31',
                'updated_at' => '2023-05-23 14:13:31',
            ),
            12 => 
            array (
                'id' => 13,
                'username' => 'DOST-XI',
                'email' => 'dost-xi@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$gMGgI1IsNuysbnG6F/Sqs.6tG2NaNChPznxOeG2oEEGICeS/N/4ny',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:36',
                'updated_at' => '2023-05-23 14:13:36',
            ),
            13 => 
            array (
                'id' => 14,
                'username' => 'DOST-XII',
                'email' => 'dost-xii@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$wVassHkyUimJdlpzewaGSeU2.uRRuf./MQohADThsfGIne5DwHjZm',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:41',
                'updated_at' => '2023-05-23 14:13:41',
            ),
            14 => 
            array (
                'id' => 15,
                'username' => 'DOST-CARAGA',
                'email' => 'dost-caraga@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$SDiizbY6bBJFM9bBX/ai/OFemkBXXdgU4IkDVchBXwHOSxyoPwjqy',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:45',
                'updated_at' => '2023-05-23 14:13:45',
            ),
            15 => 
            array (
                'id' => 16,
                'username' => 'DOST-CAR',
                'email' => 'dost-car@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$xiSjiht3GhnxMbZDocxP0u3F87yvR9cG8DekG595JSP54Hibeifum',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:49',
                'updated_at' => '2023-05-23 14:13:49',
            ),
            16 => 
            array (
                'id' => 17,
                'username' => 'DOST-BARMM',
                'email' => 'dost-barmm@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$sv6HAdHguyyWSkm7JIrLo.QuNs913qpwAq99s/KC3yz70HXZAQAxe',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:54',
                'updated_at' => '2023-05-23 14:13:54',
            ),
            17 => 
            array (
                'id' => 18,
                'username' => 'DOST-NCR',
                'email' => 'dost-ncr@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$22/09LI0mwKIxwK7Jag4q.xJcx4YKH.NCcIbE2cLLtK8Qecz0AEt2',
                           'role' => 'Staff',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2023-05-23 14:13:58',
                'updated_at' => '2023-05-23 14:13:58',
            ),
        ));
        
        
    }
}
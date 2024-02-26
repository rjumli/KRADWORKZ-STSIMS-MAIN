<?php

namespace App\Services\Utility;

use App\Models\Configuration;
use Illuminate\Support\Facades\Artisan;

class ConfigService
{
    public function variables(){
        $app_name = env('APP_NAME');
        $app_url = env('APP_URL');

        $db_database = env('DB_DATABASE');
        $db_username = env('DB_USERNAME');
        $db_password = env('DB_PASSWORD');

        $mail_mailer = env('MAIL_MAILER');
        $mail_host = env('MAIL_HOST');
        $mail_port = env('MAIL_PORT');
        $mail_username = env('MAIL_USERNAME');
        $mail_password = env('MAIL_PASSWORD');
        $mail_encryption = env('MAIL_ENCRYPTION');

        return [
            ['name' => 'APP_NAME','value' => $app_name,'line' => false],
            ['name' => 'APP_URL','value' => $app_url,'line' => true],
            ['name' => 'DB_DATABASE','value' => $db_database,'line' => false],
            ['name' => 'DB_USERNAME','value' => $db_username,'line' => false],
            ['name' => 'DB_PASSWORD','value' => $db_password,'line' => true],
            ['name' => 'MAIL_MAILER','value' => $mail_mailer,'line' => false],
            ['name' => 'MAIL_HOST','value' => $mail_host,'line' => false],
            ['name' => 'MAIL_PORT','value' => $mail_port,'line' => false],
            ['name' => 'MAIL_USERNAME','value' => $mail_username,'line' => false],
            ['name' => 'MAIL_PASSWORD','value' => $mail_password,'line' => false],
            ['name' => 'MAIL_ENCRYPTION','value' => $mail_encryption,'line' => true],
           
        ];
    }

    public function configuration(){
        $data = Configuration::where('id',1)->first();
        return $data;
    }

    public function env($request){
        $envFile = base_path('.env');

        foreach ($request->all() as $key => $value) {
            if ($key !== '_token') { // Exclude CSRF token
                $escapedValue = preg_replace('/\s+/', '', $value); // Remove whitespaces
                $envKey = strtoupper($key);
    
                file_put_contents($envFile, preg_replace(
                    "/^$envKey=(.*)/m",
                    "$envKey=$escapedValue",
                    file_get_contents($envFile)
                ));
            }
        }
        Artisan::call('config:clear');
        return ['data' => 'success'];
    }
}

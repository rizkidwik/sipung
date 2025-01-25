<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
            $config = [
                [
                    'config_code' => 'app.logo',
                    'config_title' => 'Logo',
                    'config_value' => 'logo.png',
                    'config_group' => 'app'
                ],
                [
                    'config_code' => 'app.name',
                    'config_title' => 'Name',
                    'config_value' => 'Starter Project',
                    'config_group' => 'app'
                ],
                [
                    'config_code' => 'app.description',
                    'config_title' => 'Description',
                    'config_value' => 'Description Starter Project',
                    'config_group' => 'app'
                ],
            ];
            foreach($config as $config){
                Configuration::create($config);
            }
        DB::commit();
    }
}

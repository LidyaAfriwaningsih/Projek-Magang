<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $configs = [
            ['code' => 'default_password', 'value' => 'admin'],
            ['code' => 'page_size', 'value' => '5'],
            ['code' => 'app_name', 'value' => 'Aplikasi Surat Menyurat'],
            ['code' => 'institution_name', 'value' => 'Bakesbangpol'],
            ['code' => 'institution_address', 'value' => 'Sungai Bangek'],
            ['code' => 'institution_phone', 'value' => '082121212121'],
            ['code' => 'institution_email', 'value' => 'admin@admin.com'],
            ['code' => 'language', 'value' => 'id'],
            ['code' => 'pic', 'value' => 'Lidya Afriwaningsih'],
        ];

        foreach ($configs as $config) {
            Config::updateOrInsert(
                ['code' => $config['code']], // Jika kode sudah ada, update nilainya
                ['value' => $config['value']]
            );
        }
    }
}

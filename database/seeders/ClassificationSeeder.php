<?php

namespace Database\Seeders;

use App\Models\Classification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassificationSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     *
     * @return void
     */
    public function run(): void
    {
        // Nonaktifkan foreign key constraints untuk mencegah error
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus semua data lama sebelum melakukan seeding baru
        DB::table('classifications')->truncate();

        // Aktifkan kembali foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Data classifications yang akan disisipkan
        $classifications = [
            ['code' => 'ADM', 'type' => 'Administrasi', 'description' => 'Jenis surat yang berkaitan dengan administrasi'],
            ['code' => 'HRD', 'type' => 'Sumber Daya Manusia', 'description' => 'Surat terkait kepegawaian dan SDM'],
        ];

        // Masukkan data dengan update jika sudah ada
        foreach ($classifications as $classification) {
            Classification::updateOrInsert(
                ['code' => $classification['code']], // Jika code sudah ada, update data
                [
                    'type' => $classification['type'],
                    'description' => $classification['description'],
                ]
            );
        }
    }
}

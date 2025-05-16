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
            ['code' => '000', 'type' => 'Umum', 'description' => 'Surat menyurat umum, administrasi perkantoran, dan hubungan antarinstansi.'],
            ['code' => '100', 'type' => 'Pemerintahan', 'description' => 'Urusan pemerintahan umum, otonomi daerah, kebijakan publik, dan penyelenggaraan pemerintahan.'],
            ['code' => '200', 'type' => 'Politik Dalam Negeri', 'description' => 'Kegiatan partai politik, organisasi kemasyarakatan, kehidupan demokrasi, dan pendidikan politik.'],
            ['code' => '300', 'type' => 'Keamanan dan Ketertiban', 'description' => 'Pengawasan stabilitas keamanan, ketertiban umum, deteksi dini, dan penanganan konflik sosial.'],
            ['code' => '400', 'type' => 'Kesejahteraan Sosial', 'description' => 'Pembinaan organisasi kemasyarakatan, keagamaan, sosial budaya, serta pemberdayaan masyarakat.'],
            ['code' => '800', 'type' => 'Kepegawaian', 'description' => 'Pengelolaan SDM, termasuk pengangkatan, mutasi, cuti, dan pensiun pegawai.'],
            ['code' => '900', 'type' => 'Keuangan', 'description' => 'Pengelolaan anggaran, laporan keuangan, administrasi keuangan, dan pengadaan.'],
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

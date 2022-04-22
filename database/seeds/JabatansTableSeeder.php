<?php

use Illuminate\Database\Seeder;

class JabatansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->insert([
            'nama'			=> 'Direktur Utama',
            'level'			=> '1',
        ]);

        DB::table('jabatans')->insert([
            'nama'			=> 'Kepala Bagian',
            'level'			=> '2',
        ]);

        DB::table('jabatans')->insert([
            'nama'			=> 'HRD',
            'level'			=> '3',
        ]);

        DB::table('jabatans')->insert([
            'nama'			=> 'Karyawan',
            'level'			=> '4',
        ]);

    }
}

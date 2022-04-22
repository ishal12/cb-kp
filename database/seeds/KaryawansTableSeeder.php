<?php

use Illuminate\Database\Seeder;

class KaryawansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyawans')->insert([
        	'id'					=> '1',
            'nama'					=> 'Dirut',
            'alamat'				=> 'Tenggilis',
            'Kontak'				=> '08575000000',
            'jabatan_id'			=> '1',
        ]);

        DB::table('karyawans')->insert([
        	'id'					=> '2',
            'nama'					=> 'Kabag',
            'alamat'				=> 'Rungkut',
            'Kontak'				=> '08575000001',
            'jabatan_id'			=> '2',
            'karyawan_id'			=> '1',
            'karyawan_jabatan_id'	=> '1'
        ]);

        DB::table('karyawans')->insert([
        	'id'					=> '3',
            'nama'					=> 'Hrd',
            'alamat'				=> 'Mejoyo',
            'Kontak'				=> '08575000002',
            'jabatan_id'			=> '3',
            'karyawan_id'			=> '1',
            'karyawan_jabatan_id'	=> '1'
        ]);

        DB::table('karyawans')->insert([
        	'id'					=> '4',
            'nama'					=> 'Karyawan',
            'alamat'				=> 'Selatan',
            'Kontak'				=> '08575000003',
            'jabatan_id'			=> '4',
            'karyawan_id'			=> '2',
            'karyawan_jabatan_id'	=> '2'
        ]);

    }
}

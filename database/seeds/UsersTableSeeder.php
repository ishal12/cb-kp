<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username'				=> 'ba101',
            'password'				=> bcrypt('admin101'),
            'karyawan_id'			=> '1',
            'karyawan_jabatan_id'	=> '1',
        ]);

        DB::table('users')->insert([
            'username'				=> 'ba102',
            'password'				=> bcrypt('admin102'),
            'karyawan_id'			=> '2',
            'karyawan_jabatan_id'	=> '2',
        ]);

        DB::table('users')->insert([
            'username'				=> 'ba103',
            'password'				=> bcrypt('admin103'),
            'karyawan_id'			=> '3',
            'karyawan_jabatan_id'	=> '3',
        ]);

        DB::table('users')->insert([
            'username'				=> 'ba104',
            'password'				=> bcrypt('admin104'),
            'karyawan_id'			=> '4',
            'karyawan_jabatan_id'	=> '4',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(JabatansTableSeeder::class);
    	$this->call(KaryawansTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}

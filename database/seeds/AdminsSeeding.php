<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsSeeding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [
                [
                    'firstname' => 'Admin',
                    'lastname' => 'Admin',
                    'email' => 'admin@rtls.com',
                    'password' => bcrypt('adminrtls'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'firstname' => 'berrahal',
                    'lastname' => 'ouala',
                    'email' => 'ouala@a.com',
                    'password' => bcrypt('123456'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
            ]
        );
    }
}

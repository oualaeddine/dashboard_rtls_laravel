<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(AdminsSeeding::class);
        factory(\App\Models\Person::class, 150)->create();
        factory(\App\Models\Piece::class, 32)->create();
        factory(\App\Models\Alert::class, 100)->create();
        factory(\App\Models\Seance::class, 100)->create();
    }
}

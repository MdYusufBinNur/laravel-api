<?php

use Illuminate\Database\Seeder;

class STCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DbModels\StaffTimeClock::class, 1000)->create();
    }
}

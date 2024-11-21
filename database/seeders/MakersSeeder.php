<?php

namespace Database\Seeders;

use App\Models\Maker;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makers = DB::select('select distinct make from car_db');
        $this->command->info('Makers seed started');
        $this->command->getOutput()->progressStart(count($makers));
        foreach ($makers as $key => $maker) {
            Maker::create(['name' => $maker->make]);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
        $this->command->info('Makers seeded!');
    }
}

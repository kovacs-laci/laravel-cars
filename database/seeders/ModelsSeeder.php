<?php

namespace Database\Seeders;

use App\Models\Maker;
use App\Models\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Models seed started');
        $makers = Maker::all();
        $this->command->getOutput()->progressStart(count($makers));
        foreach ($makers as $maker) {
            $models = DB::select(
                "select distinct model 
                from car_db where car_db.make = '{$maker->name}'");
            foreach ($models as $model) {
                Model::create([
                    'maker_id' => $maker->id, 
                    'name' => $model->model,
                ]);
            }
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
        $this->command->info('Models seeded');
    }
}

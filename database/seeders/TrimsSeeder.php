<?php

namespace Database\Seeders;

use App\Models\Maker;
use App\Models\Model;
use App\Models\Trim;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrimsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makers = Maker::all();
        $bar = $this->command->getOutput()->createProgressBar(count($makers));
        $bar->setFormat("%message%\n %current%/%max% [%bar%] %percent:3s%%");
        foreach ($makers as $maker) {
            $bar->setMessage($maker->name);
            $models = Model::where('maker_id', $maker->id)->get();
            foreach ($models as $model) {
                $bar->setMessage($maker->name . '/' . $model->name);
                $query = "SELECT DISTINCT trim FROM car_db WHERE model = \"{$model->name}\" AND make = '{$maker->name}'";
                $trims = DB::select($query);
                foreach ($trims as $trim) {
                    $bar->setMessage($maker->name . '/' . $model->name . '/' . $trim->trim);
                    $bar->display();
                    $item = new Trim([
                        'model_id' => $model->id,
                        'name' => str_replace('"', "'", $trim->trim),
                    ]);
                    $item->save();
                }
            }
            $bar->advance();
        }
        $bar->finish();
    }
}

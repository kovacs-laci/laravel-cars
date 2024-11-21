<?php

namespace Database\Seeders;

use App\Models\Fuel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelsSeeder extends Seeder
{
    const ITEMS = [
        'benzin',
        'dízel',
        'benzin/lpg',
        'benzin/cng',
        'dízel/lpg',
        'dízel/cng',
        'hibrid (benzin)',
        'hibrid (dízel)',
        'elektromos',
        'etanol',
        'biodízel',
        'LPG',
        'CNG',
        'hidrogén',

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::ITEMS as $item) {
            $entity = new Fuel(['name' => $item]);
            $entity->save();
        }
    }
}

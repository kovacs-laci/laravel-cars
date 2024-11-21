<?php

namespace Database\Seeders;

use App\Models\Transmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransmissionsSeeder extends Seeder
{
    const ITEMS = [
        '0 - mechanikus',
        '1 - félautomata',
        '2 - automata',
        '3 - szekvenciális',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::ITEMS as $item) {
            $entity = new Transmission(['name' => $item]);
            $entity->save();
        }
    }
}

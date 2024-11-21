<?php

namespace Database\Seeders;

use App\Models\Maker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakersLogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logoPath = 'public' . env('APP_LOGO_PATH');
        $makers = Maker::all();
        $this->command->getOutput()->progressStart(count($makers));
        foreach ($makers as $maker) {
            $logoFileName = str_replace(' ', '_', $maker->name) . '.png';
            if (!file_exists($logoPath . $logoFileName)) {
                $this->command->getOutput()->progressAdvance();
                continue;
            }
            $maker->logo = $logoFileName;
            $maker->save();
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}

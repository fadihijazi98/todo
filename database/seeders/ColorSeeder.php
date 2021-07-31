<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            'gray' => '#9CA3AF',
            'red' => '#F87171',
            'yellow' => '#FBBF24',
            'green' => '#34D399',
            'blue' => '#60A5FA',
            'purple' => '#A78BFA',
            'pink' => '#F472B6'
        ];

        foreach ($colors as $key => $value)
            Color::create([
                'name' => $key,
                'code' =>  $value
            ]);
    }
}

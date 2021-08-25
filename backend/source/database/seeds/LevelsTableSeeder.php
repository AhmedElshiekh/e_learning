<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level1 =Level::Create([
            'name' => 'Beginner',
        ]);
        $level1->save();

        $level2 =Level::Create([
            'name' => 'intermediate',
        ]);
        $level2->save();
        
        $level3 =Level::Create([
            'name' => 'Expert',
        ]);
        $level3->save();
    }
}

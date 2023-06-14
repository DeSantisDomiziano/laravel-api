<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['HTML', 'CSS', 'SASS', 'JavaScript', 'Bootstrap', 'Vue JS', 'PHP', 'MySQL', 'Laravel'];

        foreach ($types as $type ) {
            $newTech = new Technology();
            $newTech->name = $type;
            $newTech->slug = Str::slug($newTech->name);
            $newTech->save();
        }
    }
}

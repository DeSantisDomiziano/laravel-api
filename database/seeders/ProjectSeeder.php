<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            
            $newProject = new Project();
            $newProject->title = $faker->sentence(5);
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->img_path = $faker->imageUrl;
            $newProject->link_code = $faker->word();
            $newProject->link_website = $faker->word();
            $newProject->overview = $faker->text(); 
            $newProject->save();
        }
    }
}

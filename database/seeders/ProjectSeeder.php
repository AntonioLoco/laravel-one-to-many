<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create("it_IT");

        for ($i = 0; $i < 10; $i++) {
            $newProject = new Project();
            $newProject->title = $faker->sentence(3);
            $newProject->description = $faker->text(150);
            $newProject->link = $faker->text(50);
            $newProject->slug = Str::slug($newProject->title, "-");
            $newProject->save();
        }
    }
}

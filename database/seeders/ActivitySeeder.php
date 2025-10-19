<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');
        $categories = Category::all();
        $organizations = \App\Models\User::where('role', 'organization')->get();

        for ($i = 0; $i < 100; $i++) {
            $data = [
                'title' => $faker->sentence(3),
                'content' => $faker->paragraph(),
                'link' => $faker->url(),
                'points' => $faker->numberBetween(1, 20),
                'start_at' => $faker->dateTimeBetween('now', '+2 week'),
                'end_at' => $faker->dateTimeBetween('+3 week', '+1 month'),
                'category_id' => $categories->random()->id,
                'type' => $faker->numberBetween(1, 3),
            ];
            
            // Tất cả activities đều phải có organization
            if ($organizations->isNotEmpty()) {
                $data['organization_id'] = $organizations->random()->id;
            }
            
            Activity::create($data);
        }
    }
}

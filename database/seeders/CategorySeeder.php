<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories  = [
            [
                'name' => 'ملابس',
                'description' => 'show the clothes of women',
                'is_active' => false
            ],
            [
                'name' => 'الكترونيات',
                'description' => 'show the ilectronic'
            ],
            [
                'name' => 'منزل ومطبخ',
                'description' => '',
                'is_active' => false
            ]
        ];


/*            

        foreach($categories as $category){



            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
            Category::create(array_merge($category,['slug'=>Str::slug($category['name'])]));
        
            }
            */

            foreach ($categories as $category) {
                $category['slug'] = Str::slug($category['name']);

                Category::updateOrCreate(
                    ['name' => $category['name']],
                    $category
    );
}
    }
}

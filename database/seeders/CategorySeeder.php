<?php

namespace Database\Seeders;

use App\Modules\Categories\Models\Category;
use App\Modules\Categories\Models\ChildCategory;
use App\Modules\Categories\Models\Group;
use App\Modules\Currencies\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config("bookkeeper.default.categories.groups") as $group_name => $categories) {
            $group = Group::firstOrCreate([
                'name' => $group_name,
            ]);
            foreach ($categories as $category_name => $child_categories) {
                $category = Category::firstOrCreate([
                    'name' => $category_name,
                    'group_id' => $group->id,
                ]);
                foreach ($child_categories as $child_category_name) {
                    ChildCategory::firstOrCreate([
                        'name' => $child_category_name,
                        'parent_id' => $category->id,
                    ]);
                }
            }
        }
    }
}

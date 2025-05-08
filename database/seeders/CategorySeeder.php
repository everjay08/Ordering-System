<?php
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Furniture', 'Electronics', 'Decor', 'Appliances'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}

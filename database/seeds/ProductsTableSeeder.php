<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['فلل', 'منتجعات', 'شقق', 'اراضى', 'استراحات', 'ادوار', 'اخرى'];

        foreach ($products as $product) {
            Product::create([
                'name' => $product,
                'slug' => slug($product)
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Contact;
use Faker\Factory as FakerFactory;  // ここを追加

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->delete();

        $categories = [
            ['name' => '商品のお届けについて'],
            ['name' => '商品の交換について'],
            ['name' => '商品トラブル'],
            ['name' => 'ショップへのお問い合わせ'],
            ['name' => 'その他'],
        ];

        DB::table('categories')->insert($categories);

        $categoryIds = Category::pluck('id')->toArray();

        $faker = FakerFactory::create();  // Fakerのインスタンス生成

        Contact::factory()->count(35)->make()->each(function ($contact) use ($categoryIds, $faker) {
            $contact->category_id = $faker->randomElement($categoryIds);
            $contact->save();
        });
    }
}

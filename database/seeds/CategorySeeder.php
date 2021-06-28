<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\CategoryTranslation;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["breakfast", "lunch", "dinner"];
        $categories_italian = ["breakfast" => "prima colazione", "lunch" => "pranzo", "dinner" => "cena"];
        $categories_german = ["breakfast" => "Frühstück", "lunch" => "Mittagessen", "dinner" => "Abendessen"];
        $categories_croatian = ["breakfast" => "dorucak", "lunch" => "rucak", "dinner" => "vecera"];

        for ($i = 0; $i < count($categories); $i++)
        {
            $cat = new Category;
            $cat->save();

            // english
            DB::table('category_translations')->insert([
                'category_id' => $cat->id,
                'locale' => 'en',
                'translation' => $categories[$i]
            ]);

            // italian
            DB::table('category_translations')->insert([
                'category_id' => $cat->id,
                'locale' => 'ita',
                'translation' => $categories_italian[$categories[$i]]
            ]);

            // german
            DB::table('category_translations')->insert([
                'category_id' => $cat->id,
                'locale' => 'deu',
                'translation' => $categories_german[$categories[$i]]
            ]);

            // croatian
            DB::table('category_translations')->insert([
                'category_id' => $cat->id,
                'locale' => 'hrv',
                'translation' => $categories_croatian[$categories[$i]]
            ]);
        }
    }
}

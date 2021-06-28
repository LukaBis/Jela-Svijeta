<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\TagTranslation;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ["sweet", "salty", "greasy", "crispy", "healthy", "vegan", "tasty", "fast-food"];
        $tags_italian = ["sweet" => "dolce", "salty" => "salato", "greasy" => "unto", "crispy" => "croccante", "healthy" => "salutare", "vegan" => "vegano", "tasty" => "gustoso", "fast-food" => "fast-food"];
        $tags_german = ["sweet" => "Süss", "salty" => "salzig", "greasy" => "fettig", "crispy" => "knusprig", "healthy" => "gesund", "vegan" => "vegan", "tasty" => "lecker", "fast-food" => "fast-food"];
        $tags_croatian = ["sweet" => "slatko", "salty" => "slano", "greasy" => "masno", "crispy" => "hrskavo", "healthy" => "zdravo", "vegan" => "vegansko", "tasty" => "ukusno", "fast-food" => "fast-food"];

        for ($i = 0; $i < count($tags); $i++)
        {
            $tag = new Tag;
            $tag->save();

            // english
            DB::table('tag_translations')->insert([
                'tag_id' => $tag->id,
                'locale' => 'en',
                'translation' => $tags[$i]
            ]);

            // italian
            DB::table('tag_translations')->insert([
                'tag_id' => $tag->id,
                'locale' => 'ita',
                'translation' => $tags_italian[$tags[$i]]
            ]);

            // german
            DB::table('tag_translations')->insert([
                'tag_id' => $tag->id,
                'locale' => 'deu',
                'translation' => $tags_german[$tags[$i]]
            ]);

            // croatian
            DB::table('tag_translations')->insert([
                'tag_id' => $tag->id,
                'locale' => 'hrv',
                'translation' => $tags_croatian[$tags[$i]]
            ]);
        }
    }
}

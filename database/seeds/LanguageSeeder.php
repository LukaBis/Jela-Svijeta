<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = array('hrv' => 'croatian', 'en' => 'english', 'deu' => 'german', 'ita' => 'italian');

        foreach($languages as $iso => $language) {

          DB::table('languages')->insert([
              'language' => $language,
              'iso' => $iso
          ]);

        }
    }
}

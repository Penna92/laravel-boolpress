<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['vegetariano', 'senza glutine', 'carne', 'pesce'];
        // ESEMPIO DI SEEDER CON CICLO FOR
        for ($i = 0; $i < count($tags); $i++) {
            $newTag = new Tag();
            $newTag->name = $tags[$i];
            $newTag->slug = Str::of($newTag->name)->slug('-');
            //Str::slug($newTag->name); è la funzione abbreviata.
            $newTag->save();
        }
    }
}

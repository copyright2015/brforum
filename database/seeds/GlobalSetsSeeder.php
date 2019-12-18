<?php

use Illuminate\Database\Seeder;
use App\Globalset;

class GlobalSetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $new_sets = Globalset::create(
        [
            'file_size_limit' => 9000,
            'about_text' => 'Текст о борде, в формате hmlt',
            'rules_text' => 'Правила борды, в формате hmlt',
        ]
        );
    }
}

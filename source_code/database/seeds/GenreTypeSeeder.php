<?php

use Illuminate\Database\Seeder;
use App\Models\GenreType;

class GenreTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genreType = GenreType::firstOrNew([
            'slug' => 'movie',
        ]);

        if (!$genreType->exists) {
            $genreType->fill([
                'name'       => 'Movies',
            ])->save();
        }

        $genreType = GenreType::firstOrNew([
            'slug' => 'tv',
        ]);

        if (!$genreType->exists) {
            $genreType->fill([
                'name'       => 'TVs',
            ])->save();
        }
    }
}

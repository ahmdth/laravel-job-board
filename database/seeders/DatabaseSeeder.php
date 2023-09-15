<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\ListingFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::factory(10)->create();
        User::factory(10)->create()->each(function (User $user) use ($tags) {
            Listing::factory(rand(2, 5))->create([
                'user_id' => $user->id
            ])->each(function ($listing) use ($tags) {
                $listing->tags()->attach($tags->random(2));
            });
        });
    }
}

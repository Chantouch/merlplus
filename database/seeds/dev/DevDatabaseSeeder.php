<?php

use Illuminate\Database\Seeder;
use App\Model\Post;
use App\Model\User;
use App\Model\Comment;
use App\Model\NewsletterSubscription;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class DevDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        factory(User::class, 5)
            ->create()
            ->each(function ($user) use ($faker) {
                factory(Post::class, $faker->numberBetween(2, 20))
                    ->create([
                        'user_id' => $user->id
                    ])
                    ->each(function ($post) use ($faker) {
                        factory(Comment::class, $faker->numberBetween(10, 60))
                            ->create([
                                'body' => $faker->paragraph,
                                'approved' => mt_rand(1, 2),
                                'type' => mt_rand(1, 10),
                                'commentable_type' => 'App\Model\Post',
                                'commentable_id' => $post->id
                            ]);
                    });
            });

        factory(NewsletterSubscription::class, $faker->numberBetween(5, 10))->create();
        //factory(DB::table('post_categories'), $faker->numberBetween(1, 63))->create();
    }
}

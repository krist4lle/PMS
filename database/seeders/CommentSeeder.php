<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Issue;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Faker\Generator;

class CommentSeeder extends Seeder
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    public function run()
    {
        for ($i = 0; $i < 300; $i++) {
            $this->createComment();
        }
    }

    private function createComment(): void
    {
        $comment = new Comment();
        $comment->content = $this->faker->text(rand(100, 500));
        $issue = Issue::inRandomOrder()->first();
        $comment->issue()->associate($issue);
        $user = User::inRandomOrder()->first();
        $comment->user()->associate($user);
        $comment->save();
    }
}

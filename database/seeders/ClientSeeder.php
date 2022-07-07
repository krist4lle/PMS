<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Faker\Generator;

class ClientSeeder extends Seeder
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    public function run()
    {
        for ($i = 0; $i < 12; $i++) {
            $this->createClient();
        }
    }

    private function createClient(): void
    {
        $client = new Client();
        $client->title = $this->faker->unique()->company;
        $client->description = $this->faker->realText();
        $client->email = $this->faker->unique()->email;
        $client->phone = $this->faker->unique()->e164PhoneNumber;
        $client->save();
    }
}

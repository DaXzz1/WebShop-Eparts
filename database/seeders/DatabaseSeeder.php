<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BodyType;
use Illuminate\Database\Seeder;
use function League\Uri\parse;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CarSeeder::class,
            BodySeeder::class,
            CategorySeeder::class,
            CarModelSeeder::class,
//            UserSeeder::class
        ]);
    }
}

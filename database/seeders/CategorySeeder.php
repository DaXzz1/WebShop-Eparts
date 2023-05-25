<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlFile = file_get_contents(database_path("sql/categories.sql"));
        $sqlArray = explode(";", $sqlFile);

        foreach ($sqlArray as $sql) {
            if (trim($sql) != "") {
                DB::statement($sql);
            }
        }

        $this->command->info("Categories table seeded!");
    }
}

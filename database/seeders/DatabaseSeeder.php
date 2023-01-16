<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\TodoList;
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
        $this->call(UserSeeder::class);
        if(!TodoList::exists()) {
            TodoList::factory(15)->create();
        }
        if(!Todo::exists()) {
            Todo::factory(30)->create();
        }
    }
}

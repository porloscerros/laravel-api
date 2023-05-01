<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'username' => "test_user",
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(CurrencySeeder::class);
        DB::table('settings')->insert([
            'value' => config("bookkeeper.default.base_currency"),
        ]);
        $this->call(AccountSeeder::class);
        $this->call(CategorySeeder::class);
    }
}

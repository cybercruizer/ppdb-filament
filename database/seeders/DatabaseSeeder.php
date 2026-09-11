<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin12345'),
            'email_verified_at' => 
        ]);


        //call BookSeeder
        $this->call(
            [
                //BookSeeder::class,
                //PostSeeder::class,
                //ContactSeeder::class,
                taSeeder::class,
                PengaturanWebsiteSeeder::class,
            ]
        );
    }
}

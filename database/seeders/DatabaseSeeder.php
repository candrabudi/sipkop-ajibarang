<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\GeneralSetting;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'name' => 'Admin SipKop',
            'level' => 'admin',
            'password'=> bcrypt('admin'),
            'photo' => '-'
        ]);     
    }
}

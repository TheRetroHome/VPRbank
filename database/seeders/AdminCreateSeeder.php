<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminCreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'  => 'SuperAdmin',
            'email' => 'superadmin@mail.ru',
            'is_admin'  => true,
            'password'  => bcrypt('password'),
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
    }
}

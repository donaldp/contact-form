<?php

namespace Database\Seeders;

use App\Exceptions\InvalidTableException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Schema::hasTable('genders')) throw new InvalidTableException('users table does not exist.');

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@contact-us.ex',
            'password' => Hash::make('p@ssw0rd'),
        ]);
    }
}

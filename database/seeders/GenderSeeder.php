<?php

namespace Database\Seeders;

use App\Exceptions\InvalidTableException;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GenderSeeder extends Seeder
{
    /**
     * Gender list.
     *
     * @var array
     */
    private $list = [
        'Male',
        'Female',
        'Non Binary',
        'Transgender',
        'Intersex',
        'I prefer not to say'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Schema::hasTable('genders')) throw new InvalidTableException('genders table does not exist.');

        foreach($this->list as $gender) {
            DB::table('genders')->insert([
                'name' => $gender,
                'alias' => Str::slug($gender),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

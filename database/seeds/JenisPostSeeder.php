<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JenisPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Blog'],//1
            ['Forum'],
        ];

        for ($i=0; $i < count($data); $i++) {
            $jenis_post = $data[$i][0];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('jenis_post')->insert([
                'jenis_post' => $jenis_post,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

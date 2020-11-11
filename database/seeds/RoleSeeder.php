<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Admin'],//1
            ['Member'],
        ];

        for ($i=0; $i < count($data); $i++) {
            $nama_role = $data[$i][0];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('role')->insert([
                'nama_role' => $nama_role,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

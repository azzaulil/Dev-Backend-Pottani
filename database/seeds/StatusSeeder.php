<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Diajukan'],//1
            ['Ditinjau'],//2
            ['Disetujui'],//3
            ['Aktif'],//4
            ['Terdaftar'],//5
        ];

        for ($i=0; $i < count($data); $i++) {
            $status = $data[$i][0];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('status')->insert([
                'status' => $status,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

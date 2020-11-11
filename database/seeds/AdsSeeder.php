<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,'PT INKA','inka.jpg'],
        ];

        for ($i=0; $i < count($data); $i++) {
            $id_users = $data[$i][0];
            $nama_perusahaan = $data[$i][1];
            $gambar = $data[$i][2];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('ads')->insert([
                'id_users' => $id_users,
                'nama_perusahaan' => $nama_perusahaan,
                'gambar' => $gambar, 
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

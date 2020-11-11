<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [2,'Member Tes','Tes Alamat','20 Tahun','088','L'],//1
        ];

        for ($i=0; $i < count($data); $i++) {
            $id_users = $data[$i][0];
            $nama_lengkap = $data[$i][1];
            $alamat = $data[$i][2];
            $usia = $data[$i][3];
            $telepon = $data[$i][4];
            $jenis_kelamin = $data[$i][5];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('member')->insert([
                'id_users' => $id_users,
                'nama_lengkap' => $nama_lengkap,
                'alamat' => $alamat,
                'usia' => $usia,
                'telepon' => $telepon,
                'jenis_kelamin' => $jenis_kelamin,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

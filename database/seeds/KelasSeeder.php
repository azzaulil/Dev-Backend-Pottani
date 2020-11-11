<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,'Kelas Hidroponik','20200824_123156.jpg','Kelas ini mengajarkan tentang hidroponik','https://www.youtube.com/','150000'],//1
            ];

        for ($i=0; $i < count($data); $i++) {
        	$id = $data[$i][0];
            $nama = $data[$i][1];
            $poster = $data[$i][2];
            $deskripsi = $data[$i][3];
            $link_video = $data[$i][4];
            $biaya = $data[$i][5];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('class')->insert([
                'nama' => $nama,
                'poster' => $poster,
                'deskripsi' => $deskripsi,
                'link_video' => $link_video,
                'biaya' => $biaya,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

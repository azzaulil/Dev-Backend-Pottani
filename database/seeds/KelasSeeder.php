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
            ['Kelas Hidroponik : Dari Hobi Jadi Bisnis Masa Kini','IMG-20201202-WA0000.jpg','Sebuah kelas yang menghadirkan praktisi hidroponik untuk berbagi pengetahuan dan pengalaman selama menekuni hidroponik','2020-09-19','-','0', 1],//1
            ['Kelas Microgreens 101 : Get to Know More about Microgreens','IMG-20201202-WA0001.jpg','Sebuah kelas yang menghadirkan praktisi microgreens untuk berbagi pengetahuan dan pengalaman selama menekuni microgreens','2020-09-27','-','0', 2],//2
            ];

        for ($i=0; $i < count($data); $i++) {
            $nama = $data[$i][0];
            $poster = $data[$i][1];
            $deskripsi = $data[$i][2];
            $date_class = $data[$i][3];
            $link_video = $data[$i][4];
            $biaya = $data[$i][5];
            $id_class_category = $data[$i][6];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('class')->insert([
                'nama' => $nama,
                'poster' => $poster,
                'deskripsi' => $deskripsi,
                'date_class' => $date_class,
                'link_video' => $link_video,
                'biaya' => $biaya,
                'id_class_category' => $id_class_category,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

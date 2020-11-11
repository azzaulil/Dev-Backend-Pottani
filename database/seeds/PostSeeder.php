<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,1,'Tes Judul Blog','Tes Artikel Blog','blog.jpg'],//1
            [1,2,'Tes Forum Blog','Tes Artikel Forum','blog.jpg'],//1
        ];

        for ($i=0; $i < count($data); $i++) {
            $id_users = $data[$i][0];
            $id_jenis_post = $data[$i][1];
            $judul = $data[$i][2];
            $artikel = $data[$i][3];
            $gambar = $data[$i][4];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('post')->insert([
                'id_users' => $id_users,
                'id_jenis_post' => $id_jenis_post,
                'judul' => $judul,
                'artikel' => $artikel,
                'gambar' => $gambar,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KomentarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,1,null,'Tes Komentar'],//1
        ];

        for ($i=0; $i < count($data); $i++) {
            $id_users = $data[$i][0];
            $id_post = $data[$i][1];
            $parent_id = $data[$i][2];
            $komentar = $data[$i][3];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('komentar')->insert([
                'id_users' => $id_users,
                'id_post' => $id_post,
                'parent_id' => $parent_id,
                'komentar' => $komentar,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

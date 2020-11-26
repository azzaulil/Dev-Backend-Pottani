<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MemberClassSeeder extends Seeder
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
            $id_member = $data[$i][0];
            $id_class = $data[$i][1];
            $id_pembayaran = $data[$i][2];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('member_class')->insert([
                'id_member' => $id_member,
                'id_class' => $id_class,
                'id_pembayaran' => $id_pembayaran,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

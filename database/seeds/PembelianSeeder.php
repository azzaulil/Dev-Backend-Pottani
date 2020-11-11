<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,'2020-11-20',60000],//1
        ];

        for ($i=0; $i < count($data); $i++) {
            $id_member = $data[$i][0];
            $tgl_transaksi = $data[$i][1];
            $total_harga = $data[$i][2];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('pembelian')->insert([
                'id_member' => $id_member,
                'tgl_transaksi' => $tgl_transaksi,
                'total_harga' => $total_harga,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

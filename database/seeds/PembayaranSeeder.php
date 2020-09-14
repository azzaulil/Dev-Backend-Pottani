<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,'sawi.jpg','2020-10-20',1],//1
        ];

        for ($i=0; $i < count($data); $i++) {
            $id_pembelian = $data[$i][0];
            $bukti_pembayaran = $data[$i][1];
            $tgl_maks_pembayaran = $data[$i][2];
            $is_paid = $data[$i][3];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('pembayaran')->insert([
                'id_pembelian' => $id_pembelian,
                'bukti_pembayaran' => $bukti_pembayaran,
                'tgl_maks_pembayaran' => $tgl_maks_pembayaran,
                'is_paid' => $is_paid,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

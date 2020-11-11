<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DetailPembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,1,3],//1
        ];

        for ($i=0; $i < count($data); $i++) {
            $id_pembelian = $data[$i][0];
            $id_produk = $data[$i][1];
            $total_produk = $data[$i][2];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('detail_pembelian')->insert([
                'id_pembelian' => $id_pembelian,
                'id_produk' => $id_produk,
                'total_produk' => $total_produk,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,1,3,100,'Bibit Sawi','sawi.jpg',20000],//1
        ];

        for ($i=0; $i < count($data); $i++) {
            $id_member = $data[$i][0];
            $id_jenis_produk = $data[$i][1];
            $id_status = $data[$i][2];
            $stok = $data[$i][3];
            $nama_produk = $data[$i][4];
            $gambar_produk = $data[$i][5];
            $harga = $data[$i][6];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('produk')->insert([
                'id_member' => $id_member,
                'id_jenis_produk' => $id_jenis_produk,
                'id_status' => $id_status,
                'stok' => $stok,
                'nama_produk' => $nama_produk,
                'gambar_produk' => $gambar_produk,
                'harga' => $harga,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

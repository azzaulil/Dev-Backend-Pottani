<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JenisProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Bibit'],//1
            ['Sayuran'],//2
            ['Alat Pertanian'],//2
        ];

        for ($i=0; $i < count($data); $i++) {
            $jenis_produk = $data[$i][0];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('jenis_produk')->insert([
                'jenis_produk' => $jenis_produk,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('RoleSeeder');
        $this->call('UsersSeeder');
        $this->call('AdsSeeder');
        $this->call('JenisPostSeeder');
        $this->call('PostSeeder');
        $this->call('KomentarSeeder');
        $this->call('MemberSeeder');
        $this->call('KelasSeeder');
        $this->call('JenisProdukSeeder');
        $this->call('StatusSeeder');
        $this->call('ProdukSeeder');
        $this->call('PembelianSeeder');
        $this->call('DetailPembelianSeeder');
        $this->call('PembayaranSeeder');
    }
}

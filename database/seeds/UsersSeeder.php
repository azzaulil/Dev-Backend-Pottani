<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,'admin',1, 'admin@gmail.com', bcrypt('12345678')],//1
            [2,'member',1, 'member@gmail.com', bcrypt('12345678')],//1
        ];

        for ($i=0; $i < count($data); $i++) {
            $id_role = $data[$i][0];
            $username = $data[$i][1];
            $is_active = $data[$i][2];
            $email = $data[$i][3];
            $password = $data[$i][4];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('users')->insert([
                'id_role' => $id_role,
                'username' => $username,
                'is_active' => $is_active, 
                'email' => $email, 
                'password' => $password, 
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

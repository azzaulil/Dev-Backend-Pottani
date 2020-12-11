<?php

use Illuminate\Database\Seeder;

class ClassCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Hidroponik'],//1
            ['Vertikular'],//2
        ];

        for ($i=0; $i < count($data); $i++) {
            $class_category = $data[$i][0];
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            DB::table('class_category')->insert([
                'class_category' => $class_category,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

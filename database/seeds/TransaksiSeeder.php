<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            DB::table('transaksis')->insert([
                'id_user' => $faker->numberBetween(1, 10),
                'id_perusahaan' => $faker->numberBetween(1, 10),
                'file' => $faker->userName
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PerusahaanSeeder extends Seeder
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

        for($i = 1; $i<= 20; $i++)
        {
            DB::table('perusahaans')->insert([
                'nama_perusahaan' => $faker->name,
                'deskripsi' => $faker->text,
                'job_requirement' => $faker->text,
                'job_desc' => $faker->text,
                'alamat' => $faker->address,
                'file' => $faker->randomElement($array = array('jpg', 'png')),
                'deadline' => $faker->date(),
                'aktif' => $faker->numberBetween(1, 0)
            ]);
        }
    }
}

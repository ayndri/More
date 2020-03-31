<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
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
            DB::table('users')->insert([
                'nama' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('yunda'),
                'no_telepon' => $faker->phonenumber,
                'foto_profil' => $faker->name,
                'jenis_kelamin' => $faker->randomElement($array = array('Perempuan', 'Laki-Laki')),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date,
                'alamat' => $faker->address,
                'domisili' => $faker->address,
                'level' => $faker->numberBetween(1, 2),
                'status' => $faker->numberBetween(0, 3)
            ]);
        }
    }
}

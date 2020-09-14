<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "admin@mail.com";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("rahasia");
        $administrator->avatar = "https://ui-avatars.com/api/?name=Site+Administrator";
        $administrator->address = "Jl. Bunga Matahari, No.11 Gomong Lama, Mataram.";
        $administrator->phone = "081939448487";
        $administrator->save();

        $this->command->info("User Admin berhasil ditambahkan");
    }
}

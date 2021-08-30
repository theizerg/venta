<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name     = 'Theizer';
        $user->username = 'laradmin';
        $user->genero   = 'M';
        $user->lastname = 'Gonzalez';
        $user->email    = 'admin@mail.com';
        $user->password = 'admin';
        $user->status   = 1; // (1) active (0)disabled
        $user->save();

        $user->assignRole('Super Administrador');


        $user = new User;
        $user->name     = 'Dixon';
        $user->username = 'dnino';
        $user->genero   = 'F';
        $user->lastname = 'Niño';
        $user->email    = 'usuario@mail.com';
        $user->password = 'dixon2020';
        $user->status   = 1; // (1) active (0)disabled
        $user->save();

        $user->assignRole('Gerente');



        $user = new User;
        $user->name     = 'Dixyelis';
        $user->username = 'dixyelis';
        $user->genero   = 'F';
        $user->lastname = 'Niño';
        $user->email    = 'vendedor@mail.com';
        $user->password = 'admin';
        $user->status   = 1; // (1) active (0)disabled
        $user->save();

        $user->assignRole('Vendedor');
    }
}

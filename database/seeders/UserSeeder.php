<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $emails = [
            'jose@clicko.es',
            'ana@clicko.es',
            'marc@clicko.es',
            'luis@clicko.es',
            'sara@clicko.es',
            'juan@clicko.es',
            'laura@clicko.es',
            'david@clicko.es',
            'nuria@clicko.es',
            'carlos@clicko.es',
            'lucia@gmail.com',
            'mario@gmail.com',
            'elena@gmail.com',
            'miguel@gmail.com',
            'paula@gmail.com',
            'irene@outlook.es',
            'alberto@outlook.es',
            'ines@yahoo.com',
            'alba@yahoo.com',
            'hugo@clicko.es',
        ];

        foreach ($emails as $i => $email) {
            User::create([
                'name' => ucfirst(explode('@', $email)[0]),
                'email' => $email,
                'password' => Hash::make('password123'),
            ]);
        }
    }
}
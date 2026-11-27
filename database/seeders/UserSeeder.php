<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['Admin Dev Coffee', 'admin@devcoffee.test', 'admin'],
            ['Kasir Demo',       'kasir@devcoffee.test', 'kasir'],
            ['Pelanggan Demo',   'pelanggan@devcoffee.test', 'pelanggan'],
        ];

        foreach ($accounts as [$name, $email, $role]) {
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name'      => $name,
                    'password'  => 'password', // otomatis di-hash oleh cast 'hashed'
                    'role_id'   => Role::where('name', $role)->value('id'),
                    'is_active' => true,
                ]
            );
        }
    }
}
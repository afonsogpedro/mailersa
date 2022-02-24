<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
                'name' => 'Jenny',
                'email' => 'jenny@claroinsurance.com',
                'email_verified_at' => now(),
                'password' => bcrypt('$22JrClaro$**'), // password
                'phone' => '4242625511',
                'id_card' => '17370530',
                'birthday' => '1984-08-05',
                'citycod' => '1',
                'active' => 1,
                'remember_token' => Str::random(10)
        ]);

        $role = Role::find(1);

        $user->assignRole([$role->id]);
    }
}

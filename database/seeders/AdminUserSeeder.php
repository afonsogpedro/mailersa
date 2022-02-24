<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default credentials
        $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@claroinsurance.com',
                'email_verified_at' => now(),
                'password' => bcrypt('$22PaClaro$0**'), // password
                'phone' => '4166126625',
                'id_card' => '17080867',
                'birthday' => '1984-10-17',
                'citycod' => '1',
                'active' => 1,
                'remember_token' => Str::random(10)
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}

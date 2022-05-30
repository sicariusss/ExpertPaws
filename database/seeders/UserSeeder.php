<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->setSurname('admin');
        $user->setName('admin');
        $user->setPatronymic('admin');
        $user->setEmail('admin@expertpaws.ru');
        $user->setRoleId(Role::ADMIN);
        $user->setPhoto('/images/photos/photo-admin-default.png?' . Carbon::now());
        $user->setPassword(Hash::make('adminadmin'));
        $user->save();
    }
}

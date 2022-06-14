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
        $dev = new User();
        $dev->setSurname('Аллоярова');
        $dev->setName('Екатерина');
        $dev->setPatronymic('Борисовна');
        $dev->setEmail('developer@expertpaws.ru');
        $dev->setRoleId(Role::DEVELOPER);
        $dev->setPhoto('/images/photos/photo-admin-default.png?' . Carbon::now());
        $dev->setPassword(Hash::make('adminadmin'));
        $dev->save();

        $admin = new User();
        $admin->setSurname('admin');
        $admin->setName('admin');
        $admin->setPatronymic('admin');
        $admin->setEmail('admin@expertpaws.ru');
        $admin->setRoleId(Role::ADMIN);
        $admin->setPhoto('/images/photos/photo-admin-default.png?' . Carbon::now());
        $admin->setPassword(Hash::make('adminadmin'));
        $admin->save();

        $user = new User();
        $user->setSurname('user');
        $user->setName('user');
        $user->setPatronymic('user');
        $user->setEmail('user@user.user');
        $user->setRoleId(Role::USER);
        $user->setPhoto('/images/photos/default-photo.png?' . Carbon::now());
        $user->setPassword(Hash::make('useruser'));
        $user->save();
    }
}

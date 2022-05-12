<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this::roles() as $role) {
            Role::find($role['id'])?->delete();
            $model     = new Role();
            $model->id = $role['id'];
            $model->setName($role['name']);
            $model->setDisplayName($role['display_name']);
            $model->save();
        }

    }

    public function roles(): array
    {
        return [
            [
                'id'           => 1,
                'name'         => 'admin',
                'display_name' => 'Администратор',
            ],
            [
                'id'           => 2,
                'name'         => 'developer',
                'display_name' => 'Разработчик',
            ],
            [
                'id'           => 3,
                'name'         => 'manager',
                'display_name' => 'Менеджер',
            ],
            [
                'id'           => 4,
                'name'         => 'user',
                'display_name' => 'Пользователь',
            ],
        ];
    }
}

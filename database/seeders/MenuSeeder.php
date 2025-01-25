<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use App\Models\RoleMenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
        Model::unguard();
        $dashboard = Menu::create([
            'name' => 'Dashboard',
            'code' => 'dashboard',
            'url' => '/',
            'main_menu' => null,
            'icon' => 'bi bi-grid-fill'
        ]);

        // Create Main menu
        $master = Menu::create([
            'name' => 'Master',
            'code' => 'master',
            'url' => '',
            'main_menu' => null,
            'icon' => 'bi bi-justify-left',
            'menu_hassub' => 1,
        ]);

        $setting = Menu::create([
            'name' => 'Setting',
            'code' => 'setting',
            'url' => '',
            'main_menu' => null,
            'icon' => 'bi bi-gear',
            'menu_hassub' => 1,
        ]);

        // SubMenu
        $createMenu = [
            [
                'name' => 'Blog',
                'code' => 'blog',
                'url' => 'blog',
                'main_menu' => $master->id,
            ],
            [
                'name' => 'Users',
                'code' => 'user',
                'url' => 'user',
                'main_menu' => $setting->id,
            ],
            [
                'name' => 'Role',
                'code' => 'roles',
                'url' => 'role-menu',
                'main_menu' => $setting->id,
            ],
            [
                'name' => 'Configuration',
                'code' => 'App Config',
                'url' => 'configuration',
                'main_menu' => $setting->id,
            ]
        ];

        foreach($createMenu as $menu){
            Menu::create($menu);
        }
        $allMenu = Menu::get();
        $roleSuperadmin = Role::where('role_code', 'superadmin')->first();

        foreach($allMenu as $menu){
            RoleMenu::create(
                [
                    'role_id' => $roleSuperadmin->id,
                    'menu_id' => $menu->id
                ]
            );
        }
        DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        
        // $this->call("OthersTableSeeder");
    }
}

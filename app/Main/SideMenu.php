<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'principal' => [
                'icon' => 'home',
                'title' => 'Principal',
                'route_name' => 'principal',
                'permission_name' => 'tablero-list',
                'params' => [
                   'layout' => 'side-menu',
                ],
            ],
            'mail' => [
                'icon' => 'mail',
                'title' => 'Correo',
                'route_name' => 'principal',
                'permission_name' => 'tablero-list',
                'params' => [
                    'layout' => 'side-menu',
                ],
            ],
            'configuration' => [
                'icon' => 'settings',
                'title' => 'Accesos',
                'permission_name' => 'configuration-list',
                'sub_menu' => [
                    'users' => [
                        'icon' => '',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Usuarios',
                        'permission_name' => 'users-list',
                        'route_name' => 'users.index',
                    ],
                    'roles' => [
                        'icon' => '',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Roles',
                        'permission_name' => 'role-list',
                        'route_name' => 'roles.index',
                    ],
                ],
            ],
        ];
    }
}

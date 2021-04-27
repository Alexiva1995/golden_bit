<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sidebars = [
        	[
        		'type' => 1,
        		'menu' => [
                    'name' => 'inicio',
        			'text' => 'Inicio',
        			'icon' => 'icon-home',
        			'parent_id' => 0,
        			'level' => 0,
        			'subs' => [],
        			'route' => 'admin'
        		]
        	],
        	[
        		'type' => 0,
        		'header' => [
        			'text' => 'Aplicación'
        		]
        	],
        	[
        		'type' => 1,
        		'menu' => [
                    'name' => 'configuracion',
        			'text' => 'Configuración',
        			'icon' => 'icon-settings',
        			'parent_id' => 0,
        			'level' => 0,
        			'subs' => [
        				[
                            'name' => 'sistema',
		        			'text' => 'Sistema',
		        			'icon' => 'icon-settings',
		        			'level' => 1,
		        			'subs' => [],
		        			'route' => 'admin/settings'
		        		],
                        [
                            'name' => 'auth',
                            'text' => 'Autentificación',
                            'icon' => 'icon-settings',
                            'level' => 1,
                            'subs' => [],
                            'route' => 'admin/settings/auth'
                        ],
                        [
                            'name' => 'action-menu',
                            'text' => 'Action Menú',
                            'icon' => 'icon-settings',
                            'level' => 1,
                            'subs' => [],
                            'route' => 'admin/settings/action-menu'
                        ],
                        [
                            'name' => 'sidebar',
                            'text' => 'Sidebar',
                            'icon' => 'icon-settings',
                            'level' => 1,
                            'subs' => [],
                            'route' => 'admin/settings/sidebar'
                        ]
        			]
        		]
        	],
            [
                'type' => 1,
                'menu' => [
                    'name' => 'seguridad',
                    'text' => 'Seguridad',
                    'icon' => 'icon-settings',
                    'parent_id' => 0,
                    'level' => 0,
                    'subs' => [
                        [
                            'name' => 'roles',
                            'text' => 'Roles',
                            'icon' => 'icon-settings',
                            'level' => 1,
                            'subs' => [],
                            'route' => 'admin/security/roles'
                        ],
                        [
                            'name' => 'permissions',
                            'text' => 'Permisos',
                            'icon' => 'icon-settings',
                            'level' => 1,
                            'subs' => [],
                            'route' => 'admin/security/roles'
                        ],
                        [
                            'name' => 'users',
                            'text' => 'Usuarios',
                            'icon' => 'icon-settings',
                            'level' => 1,
                            'subs' => [],
                            'route' => 'admin/security/users'
                        ]
                    ]
                ]
            ],
        ];

        $index = 0;
        
        foreach( $sidebars as $sidebar ) {
        	$sidebar_id = DB::table('sidebars')->insertGetId([
        		'type' => $sidebar['type'],
        		'order' => $index
        	]);

        	$index++;

        	switch ($sidebar['type']) {
        		case 0:
        			DB::table('sidebar_headers')->insert([
        				'text' => $sidebar['header']['text'],
        				'sidebar_id' => $sidebar_id
        			]);
        			break;

        		case 1:
        			$menu_id = DB::table('sidebar_items')->insertGetId([
                        'name' => $sidebar['menu']['name'],
        				'text' => $sidebar['menu']['text'],
        				'icon' => $sidebar['menu']['icon'],
        				'parent_id' => $sidebar['menu']['parent_id'],
        				'level' => $sidebar['menu']['level'],
        				'sidebar_id' => $sidebar_id,
        				'route' => ( array_key_exists('route', $sidebar['menu']) ) ? $sidebar['menu']['route'] : null
        			]);

        			if( count( $sidebar['menu']['subs'] ) > 0 ) {
        				foreach ($sidebar['menu']['subs'] as $sub) {
        					$item_id = DB::table('sidebar_items')->insertGetId([
                                'name' => $sidebar['menu']['name'],
		        				'text' => $sub['text'],
		        				'icon' => $sub['icon'],
		        				'level' => $sub['level'],
		        				'parent_id' => $menu_id,
		        				'sidebar_id' => $sidebar_id,
		        				'route' => $sub['route']
		        			]);
        				}
        			}
        			break;
        	}
        }
    }
}

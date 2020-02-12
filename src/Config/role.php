<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Admin Template 
    |--------------------------------------------------------------------------
    |
    */
    
	'admin_tmp' => 'admin.layout.app',
	'path' => [

        'load_base_views' => false, // set true load views from base folders
        'load_base_migrations' => false, // set true load views from base folders
        
        'package_views' => base_path('vendor/kamruljpi/role/src/views'),

        'package_migrations' => base_path('vendor/kamruljpi/role/src/database/migrations'),

        'package_assets' => base_path('vendor/kamruljpi/role/src/assets'),

        'base_assets' => base_path()."/../",

        'base_views' => base_path('resources/views/kamruljpi/role'),

        'base_migrations' => database_path('migrations'),
    ]
];
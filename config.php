<?php

use eftec\bladeone\BladeOne;
use Services\Providers\RepositoryServiceProvider;
use Services\Providers\SecurityServiceProvider;

return [
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    */
    'APP_NAME' => 'MiQu',

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    */
    'environment' => Miqu\Core\AppEnvironment::DEVELOPMENT,


    /*
    |--------------------------------------------------------------------------
    | Database Configuration
    |--------------------------------------------------------------------------
    |
    | These values will be used to initiate a connection with the database.
    |
    */
    'database' => [
        'enabled' => true,
        'driver' => 'sqlite',
        'configurations' => [
            'sqlite' => [
                'database' => BASE_DIRECTORY . 'bin/database.sqlite'
            ],
            'mysql' => [
                'user' => '',
                'password' => '',
                'name' => '',
                'host' => 'localhost',
                'charset' => 'utf8',
            ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | These values will be used to setup a cache manager
    |
    */
    'cache' => [
        'enabled' => true, // enable caching
        'driver' => 'files', // the caching method. check: https://github.com/PHPSocialNetwork/phpfastcache/blob/master/docs/DRIVERS.md
        'path' => '/bin/cache/',
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage Configuration
    |--------------------------------------------------------------------------
    |
    | These values will be used to setup the Storage class
    |
    */
    'storage' => [
        'folder' => '/storage/', // base folder for the storage.
        'auto_create' => true, // auto create files and folders if it does not exist.
        'permissions' => 0777, // default file and folder permissions.
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | These values will be used to setup a Logging Manager
    |
    */
    'logging' => [
        'enabled' => true, // enable logging or not
        'path' => '/bin/logs/file.log', // path for the log file
        'time_format' => 'd.m.Y - h:i:s A',
    ],

    /*
    |--------------------------------------------------------------------------
    | Blade Configuration
    |--------------------------------------------------------------------------
    |
    | These values will be used to setup the Blade Engine
    |
    */
    'blade' => [
        'views_path' => 'Views', // base path for the views directory
        'bin_path' => 'bin/blade', // base path for the compiled versions of blade view will live in
        'mode' => BladeOne::MODE_DEBUG // blade mode
    ],

    /*
    |--------------------------------------------------------------------------
    | Mailing Configuration
    |--------------------------------------------------------------------------
    |
    | These values will be used to setup the Mailer Engine
    |
    */
    'mailing' => [
        'is_smtp' => true, // if false, the engine will use the default PHP mail function.
        'smtp' => [
            'host' => '',
            'user' => '',
            'password' => '',
            'port' => 465
        ]
    ],


    /*
    |--------------------------------------------------------------------------
    | Localization Configuration
    |--------------------------------------------------------------------------
    |
    | These values will be used to setup the LocalizationManager instance
    |
    */
    'localization' => [
        'enabled' => true, // if enabled is set to false. the translation key will always be returned when using __() function
        'default_language' => 'en', // default language to use
        'compile_path' => 'bin/translations', // folder for the compiled languages will be stored
        'languages_path' => 'Languages' // the folder that contains languages folder
    ],


    /*
    |--------------------------------------------------------------------------
    | Background Tasks
    |--------------------------------------------------------------------------
    |
    | An array that contains all the tasks and their frequencies. You need to set it up
    | by using >> php commando install:tasks
    |
    */
    'tasks' => [
        //TaskClass::class => '@hourly'
    ],

    /*
    |--------------------------------------------------------------------------
    | Service Providers
    |--------------------------------------------------------------------------
    |
    | An array that contains all the Services providers that will be invoked when the app starts up
    |
    */
    'providers' => [
        RepositoryServiceProvider::class,
        SecurityServiceProvider::class
    ]
];
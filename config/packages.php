<?php

return [

    'aws/aws-sdk-php-laravel' => [

        'type' => 'require',

        'version' => '~3.0',

        'providers' => [
            'Aws\Laravel\AwsServiceProvider',
        ],

        'aliases' => [
            'AWS' => 'Aws\Laravel\AwsFacade',
        ],

        'config' => 'https://raw.githubusercontent.com/aws/aws-sdk-php-laravel/master/config/aws.php',

    ],

    'barryvdh/laravel-debugbar' => [

        'type' => 'require',

        'version' => '^2.2',

        'providers' => [
            'Barryvdh\Debugbar\ServiceProvider',
        ],

        'config' => 'https://raw.githubusercontent.com/barryvdh/laravel-debugbar/master/config/debugbar.php',

    ],

    'barryvdh/laravel-dompdf' => [

        'type' => 'require',

        'version' => '0.6.*',

        'providers' => [
            'Barryvdh\DomPDF\ServiceProvider',
        ],

        'aliases' => [
            'PDF' => 'Barryvdh\DomPDF\Facade',
        ],

    ],

    'barryvdh/laravel-ide-helper' => [

        'type' => 'require',

        'version' => '^2.2',

        'providers' => [
            'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',
        ],

    ],

    'bestmomo/nice-artisan' => [

        'type' => 'require',

        'version' => '0.4.*',

        'providers' => [
            'Bestmomo\NiceArtisan\NiceArtisanServiceProvider',
        ],

        'config' => 'https://raw.githubusercontent.com/bestmomo/nice-artisan/master/config/commands.php',

    ], 

    'bestmomo/laravel-installer' => [

        'type' => 'require',

        'version' => '0.1.*',

        'providers' => [
            'Bestmomo\Installer\InstallerServiceProvider',
        ],

        'config' => 'https://github.com/bestmomo/laravel-installer/blob/master/config/installer.php',

    ], 

    'chumper/zipper' => [

        'type' => 'require',

        'version' => '0.6.x',

        'providers' => [
            'Chumper\Zipper\ZipperServiceProvider',
        ],

        'aliases' => [
            'Zipper' => 'Chumper\Zipper\Zipper',
        ],

    ],  

    'felixkiss/uniquewith-validator' => [

        'type' => 'require',

        'version' => '2.*',

        'providers' => [
            'Felixkiss\UniqueWithValidator\UniqueWithValidatorServiceProvider',
        ],

    ], 

    'graham-campbell/markdown' => [

        'type' => 'require',

        'version' => '^6.1',

        'providers' => [
            'GrahamCampbell\Markdown\MarkdownServiceProvider',
        ],

        'aliases' => [
            'Markdown' => 'GrahamCampbell\Markdown\Facades\Markdown',
        ],

        'config' => 'https://raw.githubusercontent.com/GrahamCampbell/Laravel-Markdown/master/config/markdown.php',

    ],  

    'intervention/image' => [

        'type' => 'require',

        'version' => '^2.3',

        'providers' => [
            'Intervention\Image\ImageServiceProvider',
        ],

        'aliases' => [
            'Image' => 'Intervention\Image\Facades\Image',
        ],

    ],  

    'kris/laravel-form-builder' => [

        'type' => 'require',

        'version' => '1.*',

        'providers' => [
            'Kris\LaravelFormBuilder\FormBuilderServiceProvider',
        ],

        'aliases' => [
            'FormBuilder' => 'Kris\LaravelFormBuilder\Facades\FormBuilder',
        ],

    ],

    'laracasts/generators' => [

        'type' => 'require-dev',

        'version' => '^1.1',

        'providers-dev' => [
            'Laracasts\Generators\GeneratorsServiceProvider',
        ],

    ],  


    'laravelcollective/html' => [

        'type' => 'require',

        'version' => '5.2.*',

        'providers' => [
            'Collective\Html\HtmlServiceProvider',
        ],

        'aliases' => [
            'Form' => 'Collective\Html\FormFacade',
            'Html' => 'Collective\Html\HtmlFacade',
        ],

    ], 

    'lucadegasperi/oauth2-server-laravel' => [

        'type' => 'require',

        'version' => '5.1.*',

        'providers' => [
            'LucaDegasperi\OAuth2Server\Storage\FluentStorageServiceProvider',
            'LucaDegasperi\OAuth2Server\OAuth2ServerServiceProvider',
        ],

        'aliases' => [
            'Authorizer' => 'LucaDegasperi\OAuth2Server\Facades\Authorizer',
        ],

        'middleware' => '\LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware',

        'routemiddlewares' => [
            "'oauth' => LucaDegasperi\OAuth2Server\Middleware\OAuthMiddleware",
            "'oauth-user' => LucaDegasperi\OAuth2Server\Middleware\OAuthUserOwnerMiddleware",
            "'oauth-client' => LucaDegasperi\OAuth2Server\Middleware\OAuthClientOwnerMiddleware",
            "'check-authorization-params' => LucaDegasperi\OAuth2Server\Middleware\CheckAuthCodeRequestMiddleware",
        ],

        'config' => 'https://raw.githubusercontent.com/lucadegasperi/oauth2-server-laravel/master/config/oauth2.php',

        'migrations' => [
            'url' => 'https://github.com/lucadegasperi/oauth2-server-laravel/archive/master.zip',
            'path' => '/oauth2-server-laravel-master/database/migrations',          
        ],
    ], 

    'maatwebsite/excel' => [

        'type' => 'require',

        'version' => '~2.1.0',

        'providers' => [
            'Maatwebsite\Excel\ExcelServiceProvider',
        ],

        'aliases' => [
            'Excel' => 'Maatwebsite\Excel\Facades\Excel',
        ],

        'config' => 'https://raw.githubusercontent.com/Maatwebsite/Laravel-Excel/2.1/src/config/excel.php',

    ], 

    'mcamara/laravel-localization' => [

        'type' => 'require',

        'version' => '1.1.*',

        'providers' => [
            'Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider',
        ],

        'aliases' => [
            'LaravelLocalization' => 'Mcamara\LaravelLocalization\Facades\LaravelLocalization',
        ],

    ], 

    'yangqi/htmldom' => [

        'type' => 'require',

        'version' => 'dev-master',

        'providers' => [
            'Yangqi\Htmldom\HtmldomServiceProvider',
        ],

        'aliases' => [
            'Htmldom' => 'Yangqi\Htmldom\Htmldom',
        ],

    ], 

    'zizaco/entrust' => [

        'type' => 'require',

        'version' => '5.2.x-dev',

        'providers' => [
            'Zizaco\Entrust\EntrustServiceProvider',
        ],

        'aliases' => [
            'Entrust' => 'Zizaco\Entrust\EntrustFacade',
        ],

        'config' => 'https://raw.githubusercontent.com/Zizaco/entrust/master/src/config/config.php',

    ], 

];

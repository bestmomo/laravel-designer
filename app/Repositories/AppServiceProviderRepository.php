<?php

namespace App\Repositories;
use Zipper;

class AppServiceProviderRepository
{
    /**
     * AppServiceProviderRepository array representation.
     *
     * @var array
     */
    protected $appServiceProvider = [];

    /**
     * Create a new appServiceProvider repository from a file.
     *
     * @param  string  $file
     * @return void
     */
    public function __construct($file)
    {
        $this->appServiceProvider = file($file);

        $key = array_search("    public function register()\n", $this->appServiceProvider);
        array_splice($this->appServiceProvider, $key + 2 , 1, '        if ($this->app->environment() == ' . "'local') {\n");
        array_splice($this->appServiceProvider, $key + 3 , 0, "        }\n");
    }

    /**
     * Insert a provider.
     *
     * @param  string  $provider
     * @return void
     */
    public function insertProvider($provider)
    {
        $key = array_search('        if ($this->app->environment() == ' . "'local') {\n", $this->appServiceProvider);

        array_splice($this->appServiceProvider, ++$key, 0, '            $this->app->register(\'' . $provider . "');\n");
    }

    /**
     * Save appServiceProvider.
     *
     * @return void
     */
    public function save($storagePath)
    {
        Zipper::make($storagePath . '/laravel.zip')
            ->remove('laravel-master/app/Providers/AppServiceProvider.php')
            ->folder('laravel-master/app/Providers')
            ->addString('AppServiceProvider.php', implode('', $this->appServiceProvider))
            ->close();
    }
}
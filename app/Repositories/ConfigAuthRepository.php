<?php

namespace App\Repositories;
use Zipper;

class ConfigAuthRepository
{
    /**
     * ConfigAuth array representation.
     *
     * @var array
     */
    protected $configAuth = [];

    /**
     * Create a new ConfigAuth repository from a file.
     *
     * @param  string  $file
     * @return void
     */
    public function __construct($file)
    {
        $this->configAuth = file($file);
    }

    /**
     * Change User namespace.
     *
     * @return void
     */
    public function changeUserNamespace()
    {
        $key = array_search("    'model' => App\User::class,\n", $this->configAuth);

        array_splice($this->configAuth, $key, 1, "    'model' => App\Models\User::class,\n");
    }

    /**
     * Save config app.
     *
     * @return void
     */
    public function save($storagePath)
    {
        Zipper::make($storagePath . '/laravel.zip')
            ->remove('laravel-master/config/auth.php')
            ->folder('laravel-master/config')
            ->addString('auth.php', implode('', $this->configAuth))
            ->close();
    }
}
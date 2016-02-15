<?php

namespace App\Repositories;
use Zipper;

class ConfigAppRepository
{
    /**
     * ConfigApp array representation.
     *
     * @var array
     */
    protected $configApp = [];

    /**
     * Base provider.
     *
     * @var string
     */
    protected $baseProvider = "        App\Providers\RouteServiceProvider::class,\n";

    /**
     * Base alias.
     *
     * @var string
     */
    protected $baseAlias = "        'View'      => Illuminate\Support\Facades\View::class,\n";

    /**
     * Create a new ConfigApp repository from a file.
     *
     * @param  string  $file
     * @return void
     */
    public function __construct($file)
    {
        $this->configApp = file($file);
    }

    /**
     * Insert a provider.
     *
     * @param  string  $provider
     * @return void
     */
    public function insertProvider($provider)
    {
        $this->insert($this->baseProvider, "        " . $provider . "::class,\n");
    }

    /**
     * Insert an alias.
     *
     * @param  string  $key
     * @param  string  $value
     * @return void
     */
    public function insertAlias($key, $value)
    {
        $spaces = strlen($key) < 11 ? str_repeat(' ', 10 - strlen($key)) : '';

        $this->insert($this->baseAlias, "        '" . $key . "'" . $spaces . "=> " . $value . "::class,\n");
    }

    /**
     * Insert item.
     *
     * @param  string  $base
     * @param  string  $item
     * @return void
     */
    private function insert($base, $item)
    {
        $key = array_search($base, $this->configApp);

        array_splice($this->configApp, ++$key, 0, $item);
    }

    /**
     * Save config app.
     *
     * @return void
     */
    public function save($storagePath)
    {
        Zipper::make($storagePath . '/laravel.zip')
            ->remove('laravel-master/config/app.php')
            ->folder('laravel-master/config')
            ->addString('app.php', implode('', $this->configApp))
            ->close();
    }
}
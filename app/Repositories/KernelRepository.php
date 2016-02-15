<?php

namespace App\Repositories;
use Zipper;

class KernelRepository
{
    /**
     * Kernel array representation.
     *
     * @var array
     */
    protected $kernel = [];

    /**
     * Base middleware.
     *
     * @var string
     */
    protected $baseMiddleware = "        \App\Http\Middleware\VerifyCsrfToken::class,\n";

    /**
     * Base route middleware.
     *
     * @var string
     */
    protected $baseRouteMiddleware = "        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,\n";

    /**
     * Create a new Kernel repository from a file.
     *
     * @param  string  $file
     * @return void
     */
    public function __construct($file)
    {
        $this->kernel = file($file);
    }

    /**
     * Insert a middleware.
     *
     * @param  string  $middleware
     * @return void
     */
    public function insertMiddleware($middleware)
    {
        $this->insert($this->baseMiddleware, "        " . $middleware . "::class,\n");
    }

    /**
     * Insert a route middleware.
     *
     * @param  string  $routeMiddleware
     * @return void
     */
    public function insertRouteMiddleware($routeMiddleware)
    {
        $this->insert($this->baseRouteMiddleware, "        " . $routeMiddleware . "::class,\n");
    }

    /**
     * Delete a middleware.
     *
     * @param  string  $middleware
     * @return void
     */
    public function deleteMiddleware($middleware)
    {
        $key = array_search($middleware, $this->kernel);

        array_splice($this->kernel, $key, 1);
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
        $key = array_search($base, $this->kernel);

        array_splice($this->kernel, ++$key, 0, $item);
    }

    /**
     * Get kernel.
     *
     * @return string
     */
    public function get()
    {
        return implode('', $this->kernel);
    }

    /**
     * Save kernel.
     *
     * @return void
     */
    public function save($storagePath)
    {
        Zipper::make($storagePath . '/laravel.zip')
            ->remove('laravel-master/app/Http/Kernel.php')
            ->folder('laravel-master/app/Http')
            ->addString('Kernel.php', implode('', $this->kernel))
            ->close();
    }

}
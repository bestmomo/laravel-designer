<?php

namespace App\Repositories;
use Zipper;

class ComposerRepository
{
    /**
     * Composer array representation.
     *
     * @var array
     */
    protected $composer = [];

    /**
     * Create a new composer repository from a file.
     *
     * @param  string  $file
     * @return void
     */
    public function __construct($file)
    {
        $this->composer = json_decode(file_get_contents($file), true);
    }

    /**
     * Insert an item.
     *
     * @param  string   $key
     * @param  string   $item
     * @param  string   $value
     * @return void
     */
    public function insert($key, $item, $value)
    {
        $this->composer[$key][$item] = $value;
    }

    /**
     * Save composer.
     *
     * @return void
     */
    public function save($storagePath)
    {
        Zipper::make($storagePath . '/laravel.zip')
            ->remove('laravel-master/composer.json')
            ->folder('laravel-master')
            ->addString('composer.json', json_encode($this->composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))
            ->close();
    }

}


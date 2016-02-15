<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ComposerRepository;
use App\Repositories\ConfigAppRepository;
use App\Repositories\ConfigAuthRepository;
use App\Repositories\KernelRepository;
use App\Repositories\AppServiceProviderRepository;

use File;
use Zipper;

class MakeController extends Controller
{

    /**
     * Laravel url.
     *
     * @var string
     */
    protected $laravelUrl = 'https://github.com/laravel/laravel/archive/master.zip';

    /**
     * Languages url.
     *
     * @var string
     */
    protected $languagesUrl = 'https://github.com/caouecs/Laravel-lang/archive/master.zip';

    /**
     * Custom folder.
     *
     * @var string
     */
    protected $folder;

    /**
     * Custom storage path.
     *
     * @var string
     */
    protected $storagePath;

    /**
     * Custom public path.
     *
     * @var string
     */
    protected $publicPath;

    /**
     * Kernel.
     *
     * @var array
     */
    protected $kernel = null;

    /**
     * App service provider.
     *
     * @var array
     */
    protected $appServiceProvider = null;

    /**
     * Show the welcome view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = array_keys(config('packages'));

        $langs = config('langs.langs');

        return view('welcome', compact('packages', 'langs'));
    }

    /**
     * Make the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function make(Request $request)
    {
        // Validation for Larvale Schema designer url
        if($request->has('lsd')) {
            $this->validate($request, [
                'urllsd' => 'required|url',
            ]);
        }

        // Set the folders
        $this->setFolders();

        // Get Laravel
        $this->getLaravel();

        // Create composer
        $composer = new ComposerRepository($this->storagePath . '/laravel-master/composer.json');

        // Create ConfigApp
        $configApp = new ConfigAppRepository($this->storagePath . '/laravel-master/config/app.php');

        // Inputs
        $inputs = $request->all();

        // Packages
        if(isset($inputs['packages'])) {

            $packages = $inputs['packages'];

            foreach ($packages as $package) {

                $base_config = 'packages.' . $package . '.';

                // Composer
                $composer->insert(config($base_config . 'type'), $package, config($base_config . 'version'));

                // ConfigApp
                if(config()->has($base_config . 'providers')) {
                    foreach (config($base_config . 'providers') as $provider) {
                        $configApp->insertProvider($provider);
                    }
                }
                if(config()->has($base_config . 'aliases')) {
                    foreach (config($base_config . 'aliases') as $key => $value) {
                        $configApp->insertAlias($key, $value);
                    }
                }

                // Config
                if(config()->has($base_config . 'config')) {
                    $this->addToConfig(config($base_config . 'config'));
                }
                
                // Views
                if(config()->has($base_config . 'views')) {
                    $this->addToViews(config($base_config . 'views.url'), config($base_config . 'views.path'), $package);
                }

                // Migrations
                if(config()->has($base_config . 'migrations')) {
                    $this->addToMigrations(config($base_config . 'migrations.url'), config($base_config . 'migrations.path'), $package);
                }

                // Middlewares
                if(config()->has($base_config . 'middleware')) {
                    $this->addToKernel(config($base_config . 'middleware'));
                }

                // Routes middlewares
                if(config()->has($base_config . 'routemiddlewares')) {
                    foreach (config($base_config . 'routemiddlewares') as $routemiddleware) {
                        $this->addToKernel($routemiddleware, true);
                    }
                }
                
                // App Service Provider
                if(config()->has($base_config . 'providers-dev')) {
                    foreach (config($base_config . 'providers-dev') as $provider) {
                        $this->addToAppServiceProvider($provider);
                    }
                }                
            }
        }

        // Set Kernel for OAuth2
        if(isset($packages) && in_array('lucadegasperi/oauth2-server-laravel', $packages)) {
            $this->kernel->deleteMiddleware('\App\Http\Middleware\VerifyCsrfToken'); 
            $this->kernel->insertRouteMiddleware("'csrf' => \App\Http\Middleware\VerifyCsrfToken");  
        }

        // .env file
        if(isset($inputs['env'])) {
            $this->setEnv();
        }

        // composer.phar
        if(isset($inputs['composer'])) {
            $this->setComposerPhar();
        }

        // laravel schema designer
        if(isset($inputs['lsd'])) {
            $this->setLaravelSchemaDesigner($request);
        }   

        // languages
        if(isset($inputs['langs']) && isset($inputs['lang'])) {
            $this->setLanguages($request);
        }      

        // app/models
        if(isset($inputs['models'])) {
            $this->setAppModels();
        }

        // app/repositories
        if(isset($inputs['repositories'])) {
            $this->setAppRepositories();
        }

        // error 404 page
        if(isset($inputs['404'])) {
            $this->setError404();
        }

        // Save composer
        $composer->save($this->storagePath);

        // Save configApp
        $configApp->save($this->storagePath);

        // Save app service provider
        if($this->appServiceProvider) {
            $this->appServiceProvider->save($this->storagePath);
        }

        // Save kernel
        if($this->kernel) {
            $this->kernel->save($this->storagePath);
        }

        // Copy zip file in public folder
        File::copy($this->storagePath . '/laravel.zip', $this->publicPath . '/laravel-master.zip');

        // Delete storage path
        File::deleteDirectory($this->storagePath);

        // Ajax response
        return response()->json(['url' => url('maker/' . $this->folder . '/laravel-master.zip')], 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Create new folder.
     *
     * @return void
     */
    protected function setFolders()
    {
        // Custom folder name
        $this->folder = Str::random(8);

        // Storage Path
        $this->storagePath = storage_path() . '/maker/' . $this->folder;
        // Create storage folder
        File::makeDirectory($this->storagePath);

        // Public path
        $this->publicPath = public_path() . '/maker/' . $this->folder;
        // Create public folder
        File::makeDirectory($this->publicPath);
    }

    /**
     * Get Laravel package.
     *
     * @return void
     */
    protected function getLaravel()
    {
        // Get Laravel
        $laravel = file_get_contents($this->laravelUrl);
        // Destination path
        $filePath = $this->storagePath . '/laravel.zip';
        // Save it in folder
        File::put($filePath, $laravel);
        // Open zip and extract in folder
        Zipper::make($filePath)->home()->extractTo($this->storagePath . '/');
    }

    /**
     * Set .env file.
     *
     * @return void
     */
    protected function setEnv()
    {
        $env = file($this->storagePath . '/laravel-master/.env.example');
        $key = Str::random(32);
        $env[2] = 'APP_KEY=' . $key . PHP_EOL;

        Zipper::make($this->storagePath . '/laravel.zip')
            ->remove('laravel-master/.env.example')
            ->folder('laravel-master')
            ->addString('.env', implode('', $env))
            ->close();       
    } 

    /**
     * Set error 404 page.
     *
     * @return void
     */
    protected function setError404()
    {
        Zipper::make($this->storagePath . '/laravel.zip')
            ->folder('laravel-master/resources/views/errors')
            ->add(base_path('resources/views/errors/404.blade.php'))
            ->close();       
    }

    /**
     * Set composer.phar.
     *
     * @return void
     */
    protected function setComposerPhar()
    {
        $file = file_get_contents('https://getcomposer.org/composer.phar');

        Zipper::make($this->storagePath . '/laravel.zip')
            ->folder('laravel-master')
            ->addString('composer.phar', $file)
            ->close();               
    } 

    /**
     * Set app/Models.
     *
     * @return void
     */
    protected function setAppModels()
    {
        // Change namespace in User file
        $user = file($this->storagePath . '/laravel-master/app/User.php');
        $user[2] = "namespace Models\App;\n";

        Zipper::make($this->storagePath . '/laravel.zip')
            ->remove('laravel-master/app/User.php')
            ->folder('laravel-master/app/Models')
            ->addString('User.php', implode('', $user))
            ->close(); 

        // Update Auth configuration
        $configAuth = new ConfigAuthRepository($this->storagePath . '/laravel-master/config/auth.php');
        $configAuth->changeUserNamespace();
        $configAuth->save($this->storagePath);              
    } 

    /**
     * Set app/Repositories.
     *
     * @return void
     */
    protected function setAppRepositories()
    {
        Zipper::make($this->storagePath . '/laravel.zip')
            ->addEmptyDir('laravel-master/app/Repositories')
            ->close();               
    }

    /**
     * Set Laravel Schema Designer.
     *
     * @param  Request  $request
     * @return void
     */
    protected function setLaravelSchemaDesigner(Request $request)
    {
        // Get export
        $export = file_get_contents($request->urllsd . '/export/all');
        // Destination path
        $filePath = $this->storagePath . '/export.zip';
        // Save it in folder
        File::put($filePath, $export);
        // Open zip and extract in folder
        Zipper::make($filePath)->home()->extractTo($this->storagePath . '/');

        // Migrations
        if($request->has('lsd_migrations')) {
            Zipper::make($this->storagePath . '/laravel.zip')
                ->folder('laravel-master/database/migrations')
                ->add($this->storagePath . '/database/migrations')
                ->close();              
        }  

        // Seeds
        if($request->has('lsd_seeds')) {
            Zipper::make($this->storagePath . '/laravel.zip')
                ->folder('laravel-master/database/seeds')
                ->add($this->storagePath . '/database/seeds')
                ->close();              
        }

        // Controllers
        if($request->has('lsd_controllers')) {
            Zipper::make($this->storagePath . '/laravel.zip')
                ->folder('laravel-master/app/Http/Controllers')
                ->add($this->storagePath . '/app/Http/Controllers')
                ->close(); 
        }

        // Routes
        if($request->has('lsd_routes')) {
            Zipper::make($this->storagePath . '/laravel.zip')
                ->folder('laravel-master/app/Http')
                ->add($this->storagePath . '/app/Http/routes.php')
                ->close();              
        } 

        File::deleteDirectory($this->storagePath . '/app/Http'); 

        // Models
        if($request->has('lsd_models')) {
            $target = $request->has('models') ? 'app/Models' : 'app';
            Zipper::make($this->storagePath . '/laravel.zip')
                ->folder('laravel-master/' . $target)
                ->add($this->storagePath . '/app')
                ->close();              
        }

        // Repositories
        if($request->has('lsd_repositories')) {
            Zipper::make($this->storagePath . '/laravel.zip')
                ->getRepository()->addEmptyDir($this->storagePath . '/app/Repositories');
            Zipper::close();
        } 

        // Views
        if($request->has('lsd_views')) {
            Zipper::make($this->storagePath . '/laravel.zip')
                ->folder('laravel-master/resources/views')
                ->add($this->storagePath . '/resources/views')
                ->close();              
        } 
  
    }

    /**
     * Set Languages.
     *
     * @param  Request  $request
     * @return void
     */
    protected function setLanguages(Request $request)
    {
        // Get package
        $languages = file_get_contents($this->languagesUrl);
        // Destination path
        $filePath = $this->storagePath . '/languages.zip';
        // Save it in folder
        File::put($filePath, $languages);
        // Open zip and extract in folder
        Zipper::make($filePath)->home()->extractTo($this->storagePath . '/');

        foreach ($request->lang as $lang) {
            Zipper::make($this->storagePath . '/laravel.zip')
                ->folder('laravel-master/resources/lang/' . $lang)
                ->add($this->storagePath . '/Laravel-lang-master/' . $lang)
                ->close();             
        }
    }

    /**
     * Add item to app service provider.
     *
     * @return void
     */
    protected function addToAppServiceProvider($provider)
    {
        if(!$this->appServiceProvider) {
            $this->appServiceProvider = new AppServiceProviderRepository($this->storagePath . '/laravel-master/app/Providers/AppServiceProvider.php');
        }

        $this->appServiceProvider->insertProvider($provider);
    }

    /**
     * Add item to Kernel.php.
     *
     * @return void
     */
    protected function addToKernel($middleware, $route = false)
    {
        if(!$this->kernel) {
            $this->kernel = new KernelRepository($this->storagePath . '/laravel-master/app/Http/Kernel.php');
        }

        if($route) {
            $this->kernel->insertRouteMiddleware($middleware);
        } else {
            $this->kernel->insertMiddleware($middleware);
        }
    } 

    /**
     * Add config file.
     *
     * @return void
     */
    protected function addToConfig($file)
    {
        $content = file_get_contents($file);

        Zipper::make($this->storagePath . '/laravel.zip')
            ->home()
            ->addString('laravel-master/config/' . basename($file), $content)
            ->close();
    }

    /**
     * Add Views.
     *
     * @return void
     */
    protected function addToViews($url, $path, $package)
    {
        $this->addFilesFromPackage($url, $path, 'laravel-master/resources/views', $package);
    }

    /**
     * Add Migrations.
     *
     * @return void
     */
    protected function addToMigrations($url, $path, $package)
    {
        $this->addFilesFromPackage($url, $path, 'laravel-master/database/migrations', $package);
    }

    /**
     * Add files from package.
     *
     * @return void
     */
    protected function addFilesFromPackage($url, $path, $target, $package)
    {
        // Get the package
        $pack = file_get_contents($url);
        // Destination path
        $filePath = $this->storagePath . '/' . str_replace('/', '-', $package);
        // Save it in folder
        File::put($filePath, $pack);

        // Open and extract zip
        Zipper::make($filePath)->home()->extractTo($this->storagePath . '/');
        // Add to Laravel zip
        Zipper::make($this->storagePath . '/laravel.zip')
            ->folder($target)
            ->add($this->storagePath . $path) 
            ->close(); 
    }

}

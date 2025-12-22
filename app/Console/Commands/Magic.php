<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Throwable;

class Magic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'magic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository, interface, and service provider binding for a new model.';

    /**
     * Execute the console command.
     */
  public function handle(): int
    {
        $model = $this->ask('Please enter name of your model [Note: Must be singular]');

        try {
            // Create Model and migration files
            Artisan::call('make:model ' . ucwords($model) . ' --migration');
            $this->line('Created Model & Migration Files');

            // Create Repository Interface file
            $newRepoInterfaceName = ucwords($model) . 'RepositoryInterface';
            $newRepoInterfacePath = 'app/Repositories/' . $newRepoInterfaceName . '.php';
            $newRepoInterfaceContent = "<?php

namespace App\Repositories;

interface $newRepoInterfaceName {

}";

            if (file_put_contents($newRepoInterfacePath, $newRepoInterfaceContent) !== false) {
                $this->line('Created Repository Interface ' . $newRepoInterfaceName);
            } else {
                $this->error('Cannot create Repository Interface ' . $newRepoInterfaceName);
            }

            // Create Repository File
            $newRepoName = ucwords($model) . 'Repository';
            $newRepoPath = 'app/Repositories/' . $newRepoName . '.php';
            $newRepoContent = "<?php

namespace App\Repositories;

use App\Models\\" . ucwords($model) . ";

class $newRepoName implements $newRepoInterfaceName {
    // You can add your repository methods here.
    // Example:
    // public function findById(int \$id): ?". ucwords($model) ."
    // {
    //     return " . ucwords($model) . "::find(\$id);
    // }
}";

            if (file_put_contents($newRepoPath, $newRepoContent) !== false) {
                $this->line('Created Repository ' . $newRepoName);
            } else {
                $this->error('Cannot create Repository ' . $newRepoName);
            }

            // Update or create RepositoryServiceProvider
            $providerPath = 'app/Providers/RepositoryServiceProvider.php';
            $useInterface = "use App\Repositories\\" . $newRepoInterfaceName . ";";
            $useRepo = "use App\Repositories\\" . $newRepoName . ";";
            $binding = "        \$this->app->bind(\n" .
                       "            $newRepoInterfaceName::class,\n" .
                       "            $newRepoName::class\n" .
                       "        );";

            if (file_exists($providerPath)) {
                // If provider exists, read and update it
                $providerContents = file_get_contents($providerPath);
                
                // Add use statements if they don't exist
                if (strpos($providerContents, $useInterface) === false) {
                    $providerContents = str_replace('use Illuminate\Support\ServiceProvider;', "use Illuminate\Support\ServiceProvider;\n" . $useInterface, $providerContents);
                }
                if (strpos($providerContents, $useRepo) === false) {
                    $providerContents = str_replace($useInterface . ';', $useInterface . ";\n" . $useRepo, $providerContents);
                }

                // Find the register method and add the binding
                $registerMethodStart = strpos($providerContents, 'public function register(): void');
                if ($registerMethodStart !== false) {
                    $registerMethodEnd = strpos($providerContents, '}', $registerMethodStart);
                    if ($registerMethodEnd !== false) {
                        $insertionPoint = strpos($providerContents, '//', $registerMethodStart);
                        if ($insertionPoint !== false && $insertionPoint < $registerMethodEnd) {
                            $providerContents = substr_replace($providerContents, "\n" . $binding . "\n", $insertionPoint, 0);
                        } else {
                            // Fallback if the comment isn't there
                            $providerContents = substr_replace($providerContents, "\n" . $binding . "\n", $registerMethodEnd, 0);
                        }
                    }
                }
                
                if (file_put_contents($providerPath, $providerContents) !== false) {
                    $this->line('Updated RepositoryServiceProvider');
                } else {
                    $this->error('Cannot Update RepositoryServiceProvider');
                }

            } else {
                // If provider does not exist, create it
                $newProviderContent = "<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
$useInterface
$useRepo

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
$binding
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
";
                if (file_put_contents($providerPath, $newProviderContent) !== false) {
                    $this->line('Created new RepositoryServiceProvider');
                    $this->info("Remember to add 'App\\Providers\\RepositoryServiceProvider::class' to the 'withProviders' method in bootstrap/app.php");
                } else {
                    $this->error('Cannot create RepositoryServiceProvider');
                }
            }
            
            // Create Controller file
            $newControllerName = ucwords($model) . 'Controller';
            $newControllerPath = 'app/Http/Controllers/' . $newControllerName . '.php';
            $modelName = strtolower($model);
            $newControllerContent = "<?php

namespace App\Http\Controllers;

use App\Repositories\\" . $newRepoInterfaceName . ";
use Illuminate\Http\Request;

class " . $newControllerName . " extends Controller
{
    protected $" . $modelName . "Repository;

    public function __construct(" . $newRepoInterfaceName . ' $' . $modelName . "Repository) {
        $" . "this->" . $modelName . "Repository = $" . $modelName . "Repository;
    }
}
";

            if (file_put_contents($newControllerPath, $newControllerContent) !== false) {
                $this->line('Created Controller ' . $newControllerName);
            } else {
                $this->error('Cannot create Controller ' . $newControllerName);
            }

            $this->line(" ");
            $this->line('****************');
            $this->line('Process completed. 😊 Happy Coding 😊');
            $this->line('Made with ❤️ by Techart Trekkies Pvt. Ltd.');
            $this->line('****************');
            $this->line(" ");
        } catch (Throwable $e) {
            $this->error("Opps!! Something Went Wrong.");
            $this->error($e->getMessage());
        }

        return 0;
    }
}
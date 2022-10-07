<?php

namespace StevenBraham\LaravelSymfonyTranslation;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\JsonFileLoader;
use Illuminate\Support\Facades\Blade;
use Riimu\Kit\PathJoin\Path;

/**
 * Loads and setups the Symfony Translation component.
 */
class LaravelSymfonyTranslationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // setup the translator component and bind it to the container
        $this->app->bind(Translator::class, function ($app) {
            $locale = config('app.locale');
            $defaultLocale = config('symfony-translation.defaultLocale');



            $translator = new Translator($locale);
            $translator->setFallbackLocales([$defaultLocale]);
            $translator->addLoader('json', new JsonFileLoader());
            $languagesPath = config('symfony-translation.translationsFolder');


            if ($locale !== $defaultLocale) {
                $translator->addResource('json', Path::join($languagesPath, $locale . '.json'), $locale);
            }

            $translator->addResource(
                'json',
                Path::join($languagesPath, $locale . '.json'),
                $defaultLocale
            );
            return $translator;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // regiseter the sTranslate blade directive to be used in the Frontend
        Blade::directive('sTranslate', function ($expression) {
            return '<?php echo SymfonyTranslation::trans(' . $expression . ') ;?>';
        });

        // publish config file
        $this->publishes([
            __DIR__ . '/config/symfony-translation.php' => config_path('symfony-translation.php'),
        ], 'config');
    }
}

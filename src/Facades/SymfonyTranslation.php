<?php

namespace StevenBraham\LaravelSymfonyTranslation\Facades;

use Illuminate\Support\Facades\Facade;
use Symfony\Component\Translation\Translator;

/**
 * Facade that provides acccess to the autowired Symfony Translator.
 * @method static string trans(string $id, array $parameters = [], string $domain = null, string $locale = null)
 */
class SymfonyTranslation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return  Translator::class;
    }
}

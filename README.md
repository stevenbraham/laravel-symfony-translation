# Laravel Symfony Translation

This is a Laravel component that allows you to easily use the [Symfony translation component](https://symfony.com/doc/current/translation.html) in your Laravel app as a replacement for the default translation library. The main advantage of the Symfony translator is that this one allows you to use multi level keys in your translations. The default Laravel translation service only works with flat objects. 

eg:

```json
{
    "navbar": {"home": "Home page", "contact": "Contact"},
    "homePage": {"title": "Homepage"}
}
```

In Laravel you would need to create a seperate `navbar.json` and `homePage.json` file, but not if using the Symfony translator.

After installing the libray, it auto binds a `Symfony\Component\Translation\Translator` instance that loads the correct json file for the current app locale. By default it assumes that your files are located in the `lang/{locale}.json` folder and the default fallback locale is `en`. 

You can overide this by publishing the config file from the service provider and edit the `symfony-translation.translationsFolder` and `symfony-translation.defaultLocale` keys.

This package also includes a blade directive `@sTranslate` that calls the `$translater->trans` function and a `SymfonyTranslation::trans()` facade arround the `Translator` object.
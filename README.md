# How to Test

1. **Build module dependencies:** `composer install`
2. **Install the module in PrestaShop:** `bin/console pre:mod install mymodule`
3. **Test in the Back Office:**
    - Enable **Debug Mode** on the `Advanced Parameters > Performance` page.
    - Go to the `Module Manager` page.
    - Search for `mymodule`.
    - Click `Configure`.

# Common Errors & Solutions

## Error 1: Private `LanguageContext` Service

**Error Message:**
```
The "PrestaShop\PrestaShop\Core\Context\LanguageContext" service or alias
 has been removed or inlined when the container was compiled.
 You should either make it public, or stop using the container directly and use dependency injection instead.
```

**Cause:**
This error is caused by the `LanguageContext::class` service being private. It cannot be called directly from the service container, as shown in the original `PrestaShopAdminController`:

```php
class PrestaShopAdminController extends AbstractController{
    // ...
    protected function getLanguageContext(): LanguageContext
    {
        return $this->container->get(languageContext::class);
    }
    // ...
}
```

## Error 2: Twig Service Not Available

**Error Message:**
```
You cannot use the "render" method if the Twig Bundle is not available.
```

**Cause:**
You cannot use the standard controller's `render` helper method because the Twig service is not publicly available from the container. Calling it directly will fail:

```php
    return $this->render(
           '@Modules/mymodule/views/templates/admin/controller/examplecontroller_controller.html.twig',
             [
                'versionInstalled' => $versionInstalled,
                'languageCode' => $languageCode,
             ]
         );
```

**Solution:**
Instead, you must inject the Twig `Environment` service into your controller's action method using autowiring:

```php
   // ...
    public function yourAction(
        Request $request,
        // To use Twig, you must inject its service directly.
        #[Autowire(service: 'twig')] Environment $twig
    ): Response {
    // ...
```

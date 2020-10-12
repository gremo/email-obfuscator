# Email Obfuscator

> I'm not the author of this package. The original package was `propaganistas/email-obfuscator` but the author decided to abandon and delete the GitHub repository, **breaking all sites** using it. I've just cloned and uploaded the latest version available.

A text filter for automatic email obfuscation using the well-established JavaScript and a CSS fallback:

- ROT13 ciphering for JavaScript-enabled browsers
- CSS reversed text direction for non-JavaScript browsers

## Installation

Install the bundle via Composer:

```bash
composer require gremo/email-obfuscator
```

Then include the supplied JavaScript file (`assets/email-obfuscator.min.js`) somewhere in your template. CND alternative (no uptime guaranteed):

```txt
https://cdn.rawgit.com/gremo/email-obfuscator/master/assets/email-obfuscator.min.js
```

### Platform specific steps

- [Standalone](#standalone)
- [Laravel 5](#laravel)
- [Twig](#twig)

#### Standalone

Require the `src/Obfuscator.php` file somewhere in your project:

```php
require_once 'PATH_TO_LIBRARY/src/Obfuscator.php';
```

Parse and obfuscate a string by using the `obfuscateEmail($string)` function.

#### Laravel 5

You have 3 options depending on your use case:

- If you want to obfuscate all email addresses that Laravel ever outputs, add the middleare class to the `$middleware` array in `App\Http\Middleware\Kernel.php`:

```php
protected $middleware = [
    \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    // ...
    \Gremo\EmailObfuscator\Laravel\Middleware::class,
];
```

This is the reccomended method.

- If you only want to have specific controller methods return obfuscated email addresses, add the Middleware class to the `$routeMiddleware` array in `App\Http\Middleware\Kernel.php`:

```php
protected $routeMiddleware = [
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    // ...
    'obfuscate' => \Gremo\EmailObfuscator\Laravel\Middleware::class,
];
```

... and apply controller middleware as usual in a controller's construct method or route definition:

```php
public function __construct()
{
    $this->middleware('obfuscate');
}
```

- If you want to apply obfuscation only on specific strings, just use the `obfuscateEmail($string)` function.

#### Twig

Add the extension to the `Twig_Environment`:

```php
$twig = new Twig_Environment(...);
$twig->addExtension(new \Gremo\EmailObfuscator\Twig\Extension());
```

The extension exposes an `obfuscateEmail` Twig filter, which can be applied to any string.

```twig
{{ "Lorem Ipsum"|obfuscateEmail }}
{{ variable|obfuscateEmail }}
```

## Credits

- [Scott Yang](http://scott.yang.id.au/2003/06/obfuscate-email-address-with-JavaScript-rot13) for the JavaScript used in this method.
- [Silvan Mühlemann](http://techblog.tilllate.com/2008/07/20/ten-methods-to-obfuscate-e-mail-addresses-compared/) for the inspiration of the CSS implementation.

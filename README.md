# Laravel DataTables Html Plugin

[![Laravel 11.x](https://img.shields.io/badge/Laravel-11.x-orange.svg)](http://laravel.com)
[![Latest Stable Version](https://img.shields.io/packagist/v/mrugeshtatvasoft/laravel-datatables-html.svg)](https://packagist.org/packages/mrugeshtatvasoft/laravel-datatables-html)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mrugeshtatvasoft/laravel-datatables-html/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mrugeshtatvasoft/laravel-datatables-html/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/mrugeshtatvasoft/laravel-datatables-html.svg)](https://packagist.org/packages/mrugeshtatvasoft/laravel-datatables-html)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/mrugeshtatvasoft/laravel-datatables-html)

[![Continuous Integration](https://github.com/mrugeshtatvasoft/laravel-datatables-html/actions/workflows/continuous-integration.yml/badge.svg)](https://github.com/mrugeshtatvasoft/laravel-datatables-html/actions/workflows/continuous-integration.yml)
[![Static Analysis](https://github.com/mrugeshtatvasoft/laravel-datatables-html/actions/workflows/static-analysis.yml/badge.svg)](https://github.com/mrugeshtatvasoft/laravel-datatables-html/actions/workflows/static-analysis.yml)
[![PHP Linting](https://github.com/mrugeshtatvasoft/laravel-datatables-html/actions/workflows/pint.yml/badge.svg)](https://github.com/mrugeshtatvasoft/laravel-datatables-html/actions/workflows/pint.yml)

This package is a plugin of [Laravel DataTables](https://github.com/mrugeshtatvasoft/laravel-datatables) for generating dataTables script using PHP.

## Requirements

- [Laravel 11.x](https://github.com/laravel/framework)
- [Laravel DataTables](https://github.com/mrugeshtatvasoft/laravel-datatables)

## Documentations

- [Laravel DataTables Documentation](http://mrugeshtatvasoftbox.com/docs/laravel-datatables)

## Laravel Version Compatibility

| Laravel       | Package |
|:--------------|:--------|
| 8.x and below | 4.x     |
| 9.x           | 9.x     |
| 10.x          | 10.x    |
| 11.x          | 11.x    |

## Quick Installation

`composer require mrugeshtatvasoft/laravel-datatables-html:^11`

#### Setup scripts with ViteJS

Set the default javascript type to `module` by setting `Builder::useVite()` in the `AppServiceProvider`.

```php
namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use mrugeshtatvasoft\DataTables\Html\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Builder::useVite();
    }
}
```

#### Publish Assets (Optional)

`$ php artisan vendor:publish --tag=datatables-html`

And that's it! Start building out some awesome DataTables!

## Contributing

Please see [CONTRIBUTING](https://github.com/mrugeshtatvasoft/laravel-datatables-html/blob/master/.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email [aqangeles@gmail.com](mailto:aqangeles@gmail.com) instead of using the issue tracker.

## Credits

- [Arjay Angeles](https://github.com/mrugeshtatvasoft)
- [All Contributors](https://github.com/mrugeshtatvasoft/laravel-datatables-html/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/mrugeshtatvasoft/laravel-datatables-html/blob/master/LICENSE.md) for more information.

# Ordering database records with Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/radiocubito/laravel-orderable.svg?style=flat-square)](https://packagist.org/packages/radiocubito/laravel-orderable)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/radiocubito/laravel-orderable/run-tests?label=tests)](https://github.com/radiocubito/laravel-orderable/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/radiocubito/laravel-orderable.svg?style=flat-square)](https://packagist.org/packages/radiocubito/laravel-orderable)


A trait to ordering database records.

## Installation

You can install the package via composer:

```bash
composer require radiocubito/laravel-orderable
```

## Usage

1. Add float column `order_column` to your model migration `$table->float('order_column', 131072, 16383)->index()`.
2. Use the trait `Radiocubito\Orderable\HasOrder` in your model.

Assuming your database for MyModel is empty:

``` php
$modelA = new MyModel();
$modelA->save(); // order_column for this record will be set to 1

$modelB = new MyModel();
$modelB->save(); // order_column for this record will be set to 2

$modelC = new MyModel();
$modelC->save(); // order_column for this record will be set to 3

$modelD = new MyModel();
$modelD->save(); // order_column for this record will be set to 4

$modelD->order_column = $modelD->orderFirst();
$modelD->save(); // order_column for this record will be set to 0

$modelA->order_column = $modelA->orderLast();
$modelA->save(); // order_column for this record will be set to 4

$modelD->order_column = $modelB->orderAfter();
$modelD->save(); // order_column for this record will be set to 2.5

$modelA->order_column = $modelC->orderBefore();
$modelA->save(); // order_column for this record will be set to 2.75
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email oliver@radiocubito.com instead of using the issue tracker.

## Credits

- [Oliver Jiménez Servín](https://github.com/oliverds)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

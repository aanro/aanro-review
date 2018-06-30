# Someline Review Service

[![Latest Version](https://img.shields.io/github/release/someline/someline-review.svg?style=flat-square)](https://github.com/someline/someline-review/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/someline/someline-review.svg?style=flat-square)](https://packagist.org/packages/someline/someline-review)

Someline Review is a part of Someline Monster Components. 

Build for Laravel and [Someline Starter](https://starter.someline.com). 

## Install

### Via Composer

Install composer package to your laravel project

``` bash
composer require someline/someline-review
```

Add Service Provider to `config/app.php`

``` php
    'providers' => [
        ...
        Someline\Review\SomelineReviewServiceProvider::class,
        ...
    ],
```

Publishing config file. 

``` bash
php artisan vendor:publish
```

After published, config file for Rest Client is `config/someline-review.php`, you will need to config it to use Rest Client.

## Usage

##### Routes

``` php
Route::post('/review', 'ReviewController@postReview');
```

## Testing

``` bash
phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/someline/someline-review/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Libern](https://github.com/libern)
- [Someline](https://github.com/someline)
- [All Contributors](https://github.com/someline/someline-review/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

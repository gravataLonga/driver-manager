![Driver Manager](DriverManager.jpg)  

# Driver Manager


[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Tests](https://github.com/gravataLonga/driver-manager/actions/workflows/run-tests.yml/badge.svg)](https://github.com/gravataLonga/driver-manager/actions/workflows/run-tests.yml)
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Driver manager is a class responsible to hold information to configure another objects, for example, database connections, logs configurations, etc

## Structure

```     
build/
src/
examples/
tests/
vendor/
```

## Install

Via Composer

``` bash
$ composer require gravataLonga/driver-manager
```

## Usage

``` php
$drivers = [
    'memory' => [
        'host' => ':memory:',
        'driver' => 'sqlite'
    ],
    'master' => [
        'host' => 'server.com',
        'username' => 'root',
        'password' => '1234',
        'driver' => 'mysql'
    ]
];
$required = ['driver', 'host'];
$default = ['timezone' => 'UTC'];
$manager = new Gravatalonga\DriverManager($drivers, $required, $default);
$setting = $manager->driver('memory');
/*
Results:  
[
    'host' => ':memory:',
    'driver' => 'sqlite',
    'timezone' => 'UTC'
]
*/
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email jonathan.alexey16@gmail.com instead of using the issue tracker.

## Credits

- [Jonathan Fontes][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/gravataLonga/driver-manager.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/gravataLonga/driver-manager/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/gravataLonga/driver-manager.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/gravataLonga/driver-manager.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/gravataLonga/driver-manager.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/gravataLonga/driver-manager
[link-travis]: https://travis-ci.org/gravataLonga/driver-manager
[link-scrutinizer]: https://scrutinizer-ci.com/g/gravataLonga/driver-manager/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/gravataLonga/driver-manager
[link-downloads]: https://packagist.org/packages/gravataLonga/driver-manager
[link-author]: https://github.com/gravataLonga
[link-contributors]: ../../contributors

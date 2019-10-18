# Adobe Stock PHP coding style validator

PHP coding style checker for all Adobe Stock PHP code [Adobe Stock](https://stock.adobe.com)

## Description

All PHP code submitted into the Stock php repositories needs to be validated against this standard.
It relies on the [PSR2 standard](http://www.php-fig.org/psr/psr-2/) with some adjustments and adds.

## Usage

First you need to install the require dependencies by running `composer install`.

Then you can run the checker it this way:
```
bin/phpcs-psr2-stock <list of php files to check>
```

You can also run the fixer it this way:
```
bin/phpcbf-psr2-stock <list of php files to check>
```

## Installation using composer

You can include this repository into another project using [composer](https://getcomposer.org/) by copying the `libs` folder and adding the following configuration into your `composer.json` file:
```
{
    "require-dev": {
        "astock/phpcs-psr2-stock": "~1.4"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "./libs/phpcs-psr2-stock"
        }
    ],
}
```

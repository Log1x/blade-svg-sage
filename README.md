# Blade SVG for Sage

[![Latest Stable Version](https://poser.pugx.org/log1x/blade-svg-sage/v/stable)](https://packagist.org/packages/log1x/blade-svg-sage) [![Total Downloads](https://poser.pugx.org/log1x/blade-svg-sage/downloads)](https://packagist.org/packages/log1x/blade-svg-sage)

Blade SVG for Sage is a wrapper for [Blade SVG](https://github.com/adamwathan/blade-svg) by Adam Wathan allowing you to easily use SVG's in your Blade templates, either as an inline SVG or SVG sprite when using Sage 9.

## Requirements

* [Sage](https://github.com/roots/sage) >= 9.0
* [PHP](https://secure.php.net/manual/en/install.php) >= 7.0
* [Composer](https://getcomposer.org/download/)

## Installation

Install via Composer:

```bash
$ composer require log1x/blade-svg-sage
```

## Configuration

Use the provided configuration filter below to modify the default configuration.

```php
add_filter('bladesvg', function () {
    return [
        'svg_path' => 'resources/svg',
        'spritesheet_path' => 'resources/svg/spritesheet.svg',
        'spritesheet_url' => '',
        'sprite_prefix' => '',
        'inline' => true,
        'class' => ''
    ];
});
```

## Usage

Please refer to the original [Blade SVG documentation](https://github.com/adamwathan/blade-svg#basic-usage) for usage examples.

Note: When calling helper functions directly, you must use the `App` namespace.

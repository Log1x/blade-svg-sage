# Blade SVG for Sage

[![Latest Stable Version](https://poser.pugx.org/log1x/blade-svg-sage/v/stable)](https://packagist.org/packages/log1x/blade-svg-sage) [![Total Downloads](https://poser.pugx.org/log1x/blade-svg-sage/downloads)](https://packagist.org/packages/log1x/blade-svg-sage)

Blade SVG for Sage is a wrapper for [Blade SVG](https://github.com/adamwathan/blade-svg) by Adam Wathan allowing you to easily use SVG's in your Blade templates, either as an inline SVG or SVG sprite when using Sage 9.

## Requirements

* [PHP](https://secure.php.net/manual/en/install.php) >= 7.0
* [Composer](https://getcomposer.org/download/)

## Installation

Install via Composer:

```bash
$ composer require log1x/blade-svg-sage
```

## Configuration

Use the provided filters below to modify the default configuration.

```php
add_filter('bladesvg_spritesheet_path', function () {
    return \BladeSvgSage\get_dist_path('images/svg/icons');
});
```

```php
add_filter('bladesvg_image_path', function () {
    return \BladeSvgSage\get_dist_path('images/svg/icons');
});
```

```php
add_filter('bladesvg_inline', function () {
    return true;
});
```

```php
add_filter('bladesvg_class', function () {
    return 'svg';
});
```

```php
add_filter('bladesvg_sprite_prefix', function () {
    return '';
});
```

## Usage
```php
<ul>
  <li>@svg('phone')</li>
  <li>{!! \BladeSvgSage\get_svg('phone-alt') !!}</li>
</ul>
```

For more examples of usage, please refer to the original [Blade SVG documentation](https://github.com/adamwathan/blade-svg/blob/master/readme.md).

# Blade SVG for Sage

[![Latest Stable Version](https://poser.pugx.org/log1x/blade-svg-sage/v/stable)](https://packagist.org/packages/log1x/blade-svg-sage) [![Total Downloads](https://poser.pugx.org/log1x/blade-svg-sage/downloads)](https://packagist.org/packages/log1x/blade-svg-sage)

Blade SVG for Sage is a wrapper for [Blade SVG](https://github.com/adamwathan/blade-svg) by Adam Wathan allowing you to easily use SVG's in your Blade templates, either as inline SVG or using SVG sprites when using Sage 9.

## Installation

#### Composer
Install via Composer:

```
$ composer require log1x/blade-svg-sage
```

## Setup
Here's a couple filters to get you started. The examples shown below are using the default values.

```
add_filter('bladesvg_spritesheet_path', function () {
    return get_dist_path('images/svg/icons');
});
```

```
add_filter('bladesvg_image_path', function () {
    return get_dist_path('images/svg/icons');
});
```

```
add_filter('bladesvg_inline', function () {
    return true;
});
```

```
add_filter('bladesvg_class', function () {
    return 'svg';
});
```

```
add_filter('bladesvg_sprite_prefix', function () {
    return '';
});
```

## Usage
```
<ul>
  <li>@svg('phone')</li>
  <li>{{ \BladeSvgSage\svg_image('phone-alt') }}</li>
</ul>
```

For more examples of usage, please refer to the original [blade-svg readme](https://github.com/adamwathan/blade-svg/blob/master/readme.md).

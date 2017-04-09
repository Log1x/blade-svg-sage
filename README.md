# Blade SVG for Sage

![Version](https://img.shields.io/badge/release-v1.0.0.beta-blue.svg)

Blade SVG for Sage is a fork of [Blade SVG](https://github.com/adamwathan/blade-svg) by Adam Wathan allowing you to easily use SVG icons in your Blade templates, either as inline SVG or using SVG sprites when using Sage 9.

## Installation

#### Composer
Recommended method for installation is [Roots Bedrock](https://github.com/roots/bedrock) or having a theme [`composer.json`](https://gist.github.com/Log1x/5f6c5cf9b9ec5d6b88208c34593090eb) with `type:wordpress-plugin` and `type:wordpress-muplugin` defined.

```
$ composer require log1x/blade-svg-sage
```

If the above works as intended, the plugin should be ready for use as it installs as an `mu-plugin`.

#### Manual
* Download the [zip file](https://github.com/Log1x/blade-svg-sage/releases/tag/v1.0.0)
* Unzip to your sites `mu-plugins` folder

## Setup
Here's a couple filters to get you started. The examples shown below are using the default values.

```
add_filter('bladesvg_spritesheet_path', function () {
    return get_stylesheet_directory() . '/dist/svg';
});
```

```
add_filter('bladesvg_icon_path', function () {
    return get_stylesheet_directory() . '/dist/svg/icons';
});
```

```
add_filter('bladesvg_inline', function () {
    return true;
});
```

```
add_filter('bladesvg_class', function () {
    return 'icon';
});
```

```
add_filter('bladesvg_sprite_prefix', function () {
    return '';
});
```

## Usage
For examples of usage, please refer to the original [blade-svg readme](https://github.com/adamwathan/blade-svg/blob/master/readme.md).

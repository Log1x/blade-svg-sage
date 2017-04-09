# Blade SVG for Sage

![Build](https://img.shields.io/badge/build-passing-brightgreen.svg)
![WordPress](https://img.shields.io/badge/wordpress-4.7.3%20tested-brightgreen.svg)
![Version](https://img.shields.io/badge/release-v1.0.0-green.svg)

Blade SVG for Sage is a fork of Blade SVG by Adam Wathan allowing you to easily use SVG icons in your Blade templates, either as inline SVG or using SVG sprites when using Sage 9.

## Installation

**Composer**
Recommended method for installation is [Roots Bedrock](https://github.com/roots/bedrock) or [WP-CLI](http://wp-cli.org/)

```
$ composer require log1x/blade-svg-sage
$ wp plugin activate blade-svg-sage
```

## Setup
Here's a couple filters to get you started. The examples shown below are using the default values.

```
add_filter('bladesvg_spritesheet_path', function () {
    return \App\sage('assets')->get('svg');
});
```

```
add_filter('bladesvg_icon_path', function () {
    return \App\sage('assets')->get('svg/icons');
});
```

```
add_filter('bladesvg_bladesvg_inline', function () {
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
For examples of usage, please refer to the original [blade-svg](https://github.com/adamwathan/blade-svg) docs.

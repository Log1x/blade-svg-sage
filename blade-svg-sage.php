<?php
/*
Plugin Name:        BladeSvg for Sage
Plugin URI:         http://github.com/log1x/blade-svg-sage
Description:        WordPress plugin to add BladeSvg to Sage 9
Version:            1.0.0
Author:             Log1x
Author URI:         http://github.com/log1x/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
GitHub Plugin URI:  log1x/blade-svg-sage
GitHub Branch:      master
*/

namespace BladeSvg;

use BladeSvg\IconFactory;

/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Ensure dependencies are loaded
 */
if (!file_exists($composer = __DIR__.'/vendor/autoload.php') && !file_exists($composer = __DIR__.'/dist/autoload.php')) {
    return new \WP_Error('<h1>Error</h1><p>Please run `composer install` to use Sage Svg.</p>', 'Autoloader not found.');
}
require_once $composer;

/**
 * Initialize the plugin
 */
function init()
{
    \App\sage()->singleton(IconFactory::class, function () {
        $config = [
            'spritesheet_path' => apply_filters('bladesvg_spritesheet_path', \App\sage('assets')->get('svg'),
            'icon_path'        => apply_filters('bladesvg_icon_path', \App\sage('assets')->get('svg/icons'),
            'inline'           => apply_filters('bladesvg_inline', true),
            'class'            => apply_filters('bladesvg_class', 'icon'),
            'sprite_prefix'    => apply_filters('bladesvg_spritesheet_path', '')
        ];

        return new IconFactory($config);
    });
}

/**
 * Create @icon() Blade directive
 */
function directive()
{
    \App\sage('blade')->compiler()->directive('icon', function ($expression) {
        return "<?php echo e(svg_icon($expression)); ?>";
    });
}

add_action('after_setup_theme', __NAMESPACE__ . '\init', 30);
add_action('after_setup_theme', __NAMESPACE__ . '\directive', 30);

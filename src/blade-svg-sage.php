<?php
/*
Plugin Name:        Blade SVG for Sage
Plugin URI:         http://github.com/log1x/blade-svg-sage
Description:        Simple package to add Blade SVG to Sage 9
Version:            1.0.5
Author:             Log1x
Author URI:         https://log1x.com
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
GitHub Plugin URI:  log1x/blade-svg-sage
GitHub Branch:      master
*/

namespace BladeSvgSage;

use function App\sage;
use BladeSvg\SvgFactory;

/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Initialize the plugin
 */
function init()
{
    if (function_exists('\App\sage')) {
        sage()->singleton(SvgFactory::class, function () {
            $config = [
                'spritesheet_path' => apply_filters('bladesvg_spritesheet_path', get_dist_path('images/svg/icons')),
                'svg_path'         => apply_filters('bladesvg_image_path', get_dist_path('images/svg/icons')),
                'inline'           => apply_filters('bladesvg_inline', true),
                'class'            => apply_filters('bladesvg_class', 'svg'),
                'sprite_prefix'    => apply_filters('bladesvg_sprite_prefix', '')
            ];

            return new SvgFactory($config);
        });
    }
}

/**
 * Create @svg() Blade directive
 */
function directive()
{
    if (function_exists('\App\sage')) {
        sage('blade')->compiler()->directive('icon', function ($expression) {
            return "<?php echo e(svg_image($expression)) ?>";
        });

        sage('blade')->compiler()->directive('svg', function ($expression) {
            return "<?php echo e(svg_image($expression)) ?>";
        });
    }
}

add_action('after_setup_theme', __NAMESPACE__ . '\init', 30);
add_action('after_setup_theme', __NAMESPACE__ . '\directive', 30);

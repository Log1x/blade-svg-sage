<?php

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
 * Initialize SvgFactory
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
            return "<?php echo e(\BladeSvgSage\svg_image($expression)) ?>";
        });

        sage('blade')->compiler()->directive('svg', function ($expression) {
            return "<?php echo e(\BladeSvgSage\svg_image($expression)) ?>";
        });
    }
}

add_action('after_setup_theme', __NAMESPACE__ . '\init', 30);
add_action('after_setup_theme', __NAMESPACE__ . '\directive', 30);

<?php

namespace BladeSvgSage;

/**
 * Return if BladeSvgSage already exists.
 */
if (class_exists('BladeSvgSage')) {
    return;
}

/**
 * Blade SVG for Sage
 */
class BladeSvgSage
{
    /**
     * Constructor
     */
    public function __construct()
    {
        if (!function_exists('\App\sage') || !class_exists('\BladeSvg\SvgFactory')) {
            return;
        }

        $this->register();
        $this->directives();
    }

    /**
     * Register SvgFactory with the Sage container.
     *
     * @return \BladeSvg\SvgFactory
     */
    public function register()
    {
        sage()->singleton(\BladeSvg\SvgFactory::class, function () {
            $config = [
                'spritesheet_path' => apply_filters('bladesvg_spritesheet_path', get_dist_path('images/svg/icons')),
                'svg_path'         => apply_filters('bladesvg_image_path', get_dist_path('images/svg/icons')),
                'inline'           => apply_filters('bladesvg_inline', true),
                'class'            => apply_filters('bladesvg_class', 'svg'),
                'sprite_prefix'    => apply_filters('bladesvg_sprite_prefix', '')
            ];

            return new \BladeSvg\SvgFactory($config);
        });
    }

    /**
     * Register Directives with Blade.
     *
     * @return void
     */
    public function directives()
    {
        /** Create @icon() Blade directive */
        sage('blade')->compiler()->directive('icon', function ($expression) {
            return "<?php echo e(\BladeSvgSage\BladeSvgSage::icon({$expression})) ?>";
        });

        /** Create @svg() Blade directive */
        sage('blade')->compiler()->directive('svg', function ($expression) {
            return "<?php echo e(\BladeSvgSage\BladeSvgSage::icon({$expression})) ?>";
        });
    }

    /**
     * Returns the local filesystem path to the theme directory.
     *
     * @param  string $path
     * @param  string $directory
     * @return string
     */
    public static function distPath($path = '', $directory = 'dist')
    {
        return str_finish(\App\config('theme.dir'), '/') . $directory . !empty($path) ? str_start($path, '/') : null;
    }

    /**
     * Returns the local filesystem path to the filtered SVG directory.
     *
     * @return string
     */
    public static function directory()
    {
        return apply_filters('bladesvg_image_path', self::distPath('images/svg/icons'));
    }

    /**
     * Returns the local filesystem path to the specified SVG.
     *
     * @param  string $image
     * @return string
     */
    public static function path($image = '')
    {
        if (empty($image)) {
            return;
        }

        return str_finish(self::directory(), '/') . str_finish($image, '.svg');
    }

    /**
     * Returns the local filesystem path to the specified cached busted SVG.
     *
     * @param  string $image
     * @return string
     */
    public static function svg($image = '')
    {
        if (empty($image) || !class_exists('\Wikimedia\RelPath')) {
            return;
        }

        $image = \Wikimedia\RelPath::getRelativePath(
            \Wikimedia\RelPath::joinPath(
                self::distPath(),
                sage('assets')->get(RelPath::getRelativePath(self::path($image), self::distPath()))
            ), self::directory()
        );

        return substr($image, 0, strrpos($image, '.'));
    }

    /**
     * Returns the rendered SVG of the specified image.
     *
     * @param  string $image
     * @param  string $class
     * @param  array  $args
     * @return mixed
     */
    public static function render($image = '', $class = '', $args = [])
    {
        if (empty($image)) {
            return;
        }

        return sage(\BladeSvg\SvgFactory::class)->svg(self::svg($image), $class, $attrs);
    }
}

/**
 * Initialize BladeSvgSage
 */
add_action('after_setup_theme', function () {
    return new BladeSvgSage;
}, 30);

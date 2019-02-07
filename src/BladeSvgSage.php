<?php

namespace BladeSvgSage;

use BladeSvg\SvgFactory;

use function App\sage;

/**
 * Blade SVG for Sage
 */
class BladeSvgSage
{
    /**
     * Configuration
     *
     * @var array
     */
    protected $config;

    /**
     * Constructor
     */
    public function __construct()
    {
        if (! function_exists('App\\sage') || ! class_exists('BladeSvg\\SvgFactory') || ! $this->config()) {
            return;
        }

        $this->register();
        $this->directives();
    }

    /**
     * Register BladeSvgSage and SvgFactory with the Sage container.
     *
     * @return void
     */
    public function register()
    {
        sage()->singleton(BladeSvgSage::class, function () {
            return $this;
        });

        sage()->singleton(SvgFactory::class, function () {
            return new SvgFactory($this->config());
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
            return "<?php echo e(App\svg_image({$expression})) ?>";
        });

        /** Create @svg() Blade directive */
        sage('blade')->compiler()->directive('svg', function ($expression) {
            return "<?php echo e(App\svg_image({$expression})) ?>";
        });

        /** Create @spritesheet Blade directive */
        sage('blade')->compiler()->directive('spritesheet', function () {
            return "<?php echo e(App\svg_spritesheet()) ?>";
        });
    }

    /**
     * Returns the config.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function config()
    {
        if (! file_exists($config = __DIR__.'/../config/config.php')) {
            return;
        }

        $config = collect(apply_filters('bladesvg', require($config)));

        return $config->merge([
            'svg_path'         => $this->path($config->get('svg_path')),
            'spritesheet_path' => $this->path($config->get('spritesheet_path'))
        ])->all();
    }

    /**
     * Returns the local filesystem path to the theme directory.
     *
     * @param  string $path
     * @return string
     */
    public function path($path = '')
    {
        return \App\config('theme.dir') . (! empty($path) ? str_start($path, '/') : null);
    }

    /**
     * Returns the rendered spritesheet.
     *
     * @return string
     */
    public function spritesheet()
    {
        return sage(SvgFactory::class)->spritesheet();
    }

    /**
     * Returns the rendered SVG for the image specified.
     *
     * @param  string $name
     * @param  string $class
     * @param  array  $attrs
     * @return mixed
     */
    public function svg($name = '', $class = '', $attrs = [])
    {
        if (empty($name)) {
            return;
        }

        return sage(SvgFactory::class)->svg($name, $class, $attrs);
    }
}

/**
 * Initialize BladeSvgSage
 */
if (function_exists('add_action')) {
    add_action('after_setup_theme', function () {
        return new BladeSvgSage;
    }, 20);
}

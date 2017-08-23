<?php

use BladeSvg\SvgFactory;

if (!function_exists('svg_spritesheet')) {
    function svg_spritesheet()
    {
        return \App\sage(SvgFactory::class)->spritesheet();
    }
}

if (!function_exists('svg_image')) {
    function svg_image($icon, $class = '', $attrs = [])
    {
        return \App\sage(SvgFactory::class)->svg($icon, $class, $attrs);
    }
}

if (!function_exists('svg_icon')) {
    /**
     * @deprecated  Use `svg_image`
     */
    function svg_icon($icon, $class = '', $attrs = [])
    {
        return \App\sage(SvgFactory::class)->svg(\App\sage('assets')->get($icon), $class, $attrs);
    }
}

if (!function_exists('get_dist_path')) {
    function get_dist_path($path)
    {
        return trailingslashit(\App\config('theme.dir')) . trailingslashit('dist') . $path;
    }
}

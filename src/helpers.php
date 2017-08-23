<?php

if (!function_exists('get_dist_path')) {
    function get_dist_path($path)
    {
        return trailingslashit(\App\config('theme.dir')) . trailingslashit('dist') . $path;
    }
}

if (!function_exists('svg_image')) {
    function svg_image($icon, $class = '', $attrs = [])
    {
        return \App\sage(\BladeSvg\SvgFactory::class)->svg(\App\sage('assets')->get($icon), $class, $attrs);
    }
}

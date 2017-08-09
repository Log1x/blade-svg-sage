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
        return \App\sage(SvgFactory::class)->svg($icon, $class, $attrs);
    }
}

if (!function_exists('parse_asset_path')) {
    function parse_asset_path($asset)
    {
        // An ugly workaround for Sage's asset_path not returning a full absolute path.
        // Feel free to submit a PR if it can be done better.
        return trailingslashit(\App\config('theme')['dir']) . trailingslashit('dist') . \App\sage('assets')->get($asset);
    }
}

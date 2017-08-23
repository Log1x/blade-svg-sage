<?php

namespace BladeSvgSage;

use function App\sage;
use function App\config;

/**
 * Get Sage's dist path
 *
 * @param  string $path
 * @return string
 */
function get_dist_path($path)
{
    return trailingslashit(config('theme.dir')) . trailingslashit('dist') . $path;
}

/**
 * Simple helper for our directive.
 *
 * @param  string $icon
 * @param  string $class
 * @param  array  $attrs
 * @return mixed
 */
function svg_image($icon, $class = '', $attrs = [])
{
    return sage(\BladeSvg\SvgFactory::class)->svg(sage('assets')->get($icon), $class, $attrs);
}

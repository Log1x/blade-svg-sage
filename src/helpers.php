<?php

namespace App;

use BladeSvgSage\BladeSvgSage;

/**
 * Returns the rendered spritesheet.
 *
 * @return string
 */
if (! function_exists('App\\svg_spritesheet')) {
    function svg_spritesheet()
    {
        return sage(BladeSvgSage::class)->spritesheet();
    }
}

/**
 * Returns the rendered SVG for the image specified.
 *
 * @param  string $name
 * @param  string $class
 * @param  array  $attrs
 * @return string
 */
if (! function_exists('App\\svg_image')) {
    function svg_image($name = '', $class = '', $attrs = [])
    {
        if (empty($name)) {
            return;
        }

        return sage(BladeSvgSage::class)->svg($name, $class, $attrs);
    }
}

<?php

namespace App;

/**
 * Returns the rendered SVG for the image specified.
 *
 * @param  string $image
 * @param  string $class
 * @param  array  $args
 * @return string
 */
function get_svg($image = '', $class = '', $args = [])
{
    return \BladeSvgSage\BladeSvgSage::render($image, $class, $args);
}

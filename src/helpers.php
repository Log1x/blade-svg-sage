<?php

namespace BladeSvgSage;

use function App\sage;
use function App\config;
use function App\asset_path;
use \Wikimedia\RelPath;

/**
 * Get Sage's dist path
 *
 * @param  string $path
 * @return string
 */
function get_dist_path($path = '')
{
	$dist_path = trailingslashit(config('theme.dir'));

	if(!empty($path)) {
		$dist_path .= trailingslashit('dist') . $path;
	} else {
		$dist_path .= 'dist';
	}

	return $dist_path;
}


/**
 * Returns path to svg dir
 *
 * @param  string $icon
 * @return string
 */
function get_svg_path() {
	return apply_filters('bladesvg_image_path', get_dist_path('images/svg/icons'));
}

/**
 * Returns absolute path to icon
 *
 * @param  string $icon
 * @return string
 */
function get_icon_path_abs($icon) {
	return trailingslashit(get_svg_path()) . $icon . '.svg';
}

/**
 * Returns path to icon in a sage theme
 *
 * @param  string $icon
 * @return string
 */
function get_icon_sage_path($icon)
{
	// 1. Absolute path to icon
	$icon_abs_path    = get_icon_path_abs($icon);

	// 2. Icon path relative to sage dist dir
	$icon_rel_dist    = RelPath::getRelativePath($icon_abs_path, get_dist_path());

	// 3. Icon path with proper hash relative to svg dir (itself being relative to dist dir)
	$icon_asset_path  = sage('assets')->get($icon_rel_dist);

	// 4. Absolute path to icon with proper hash
	$icon_path_abs = RelPath::joinPath(get_dist_path(), $icon_asset_path);

	// 5. Icon path relative to dist dir
	$icon_path_rel = RelPath::getRelativePath($icon_path_abs, get_svg_path());

	// 6. Final icon path without extension expected
	$icon_imgpath_noext = pathinfo($icon_path_rel, PATHINFO_FILENAME);

	return $icon_imgpath_noext;
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
	// sage asset expectes relative path (production builds)
	// see https://discourse.roots.io/t/asset-hashes/10261
	// see https://github.com/roots/sage-lib/blob/d7789609eae857e910812cf62ae55355b836ad58/Assets/JsonManifest.php#L33
	$icon_sage_path = get_icon_sage_path($icon);

    return sage(\BladeSvg\SvgFactory::class)->svg($icon_sage_path, $class, $attrs);
}

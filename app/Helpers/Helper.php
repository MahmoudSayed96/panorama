<?php

/**
 * @file
 * Contains app helper functions.
 */

use Illuminate\Support\Str;

define('DS', DIRECTORY_SEPARATOR);

/**
 * Implements function to get current user.
 *
 * @return App\User $user.
 *  Return current user object.
 */
if (!function_exists('currentUser')) {
    function currentUser()
    {
        return auth()->user();
    }
}

/**
 * Check active sidebar link.
 *
 * @param string $route_name.
 *  Current link url route name.
 * @return string
 * Return "active" if matched.
 */
if (!function_exists('is_active_route')) {
    function is_active_route(string $route_name = NULL)
    {
        return NULL !== request()->segment(2) && request()->segment(2) == $route_name ? true : false;
    }
}

/**
 * Create slug.
 *
 * @param string $src.
 *  Sources string.
 * @return string $slug
 * Return slug.
 */
if (!function_exists('slug')) {
    function slug(string $value = NULL)
    {
        return strtolower(trim(str_replace(' ', '-', $value)));
    }
}

if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

/**
 * Implement function for format decimal numbers.
 * 
 * @param $number.
 * Number to format it.
 * @return $format.
 * Return number after format it.
 */
if (!function_exists('formatNumber')) {
    function formatNumber($number)
    {
        return number_format($number, 2);
    }
}

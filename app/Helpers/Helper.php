<?php

/**
 * @file
 * Contains app helper functions.
 */

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
        return NULL !== request()->segment(2) && request()->segment(2) == $route_name ? 'active' : '';
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

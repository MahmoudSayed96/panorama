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
 * Implement function for upload image file.
 *
 * @param string $folder
 *  Folder name for save image inside it.
 * @param $image
 *  Upload file object.
 * @return string $path
 *  Return image file path after save.
 */
if (!function_exists('uploadImage')) {
    function uploadImage($folder, $image)
    {
        $image->store(DS, $folder);
        $imageName = $image->hashName();
        $path = 'uploads' . DS . 'images' . DS . $folder . DS . $imageName;
        return $path;
    }
}

/**
 * Implement function for delete image from folder.
 *
 * @param string $folder
 *  Folder name that contains images folders inside it.
 * @param $image
 *  Image name.
 */
if (!function_exists('removeImage')) {
    function removeImage($folder, $image)
    {
        $imagePath = public_path() . DS . $image;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}

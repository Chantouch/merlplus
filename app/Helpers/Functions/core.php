<?php

/**
 * Get image extension from base64 string
 *
 * @param $bufferImg
 * @param bool $recursive
 * @return bool
 */
function is_png($bufferImg, $recursive = true)
{
    $f = finfo_open();
    $result = finfo_buffer($f, $bufferImg, FILEINFO_MIME_TYPE);

    if (!str_contains($result, 'image') && $recursive) {
        // Plain Text
        return str_contains($bufferImg, 'image/png');
    }

    return $result == 'image/png';
}
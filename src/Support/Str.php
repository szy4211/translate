<?php

namespace Szy4211\Translate\Support;

/**
 * Class Str
 *
 *
 * @package Szy4211\Translate\Support
 */
class Str
{
    /**
     * Generate random strings
     *
     * @param int $length
     *
     * @return string
     * @throws \Exception
     */
    public static function random($length = 16)
    {
        $str = '';
        while (($len = strlen($str)) < $length) {
            $size  = $length - $len;
            $bytes = random_bytes($size);

            $str .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $str;
    }
}
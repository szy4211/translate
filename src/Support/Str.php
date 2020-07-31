<?php

/*
 * This file is part of the szy4211/translate.
 *
 * (c) zornshuai <zornshuai@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Szy4211\Translate\Support;

/**
 * Class Str.
 */
class Str
{
    /**
     * Generate random strings.
     *
     * @param int $length
     *
     * @return string
     *
     * @throws \Exception
     */
    public static function random($length = 16)
    {
        $str = '';
        while (($len = strlen($str)) < $length) {
            $size = $length - $len;
            $bytes = random_bytes($size);

            $str .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $str;
    }
}

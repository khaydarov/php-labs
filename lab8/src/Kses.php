<?php

declare(strict_types=1);

namespace App;

/**
 * Class Kses
 * @package App
 */
class Kses implements Sanitizer
{
    /**
     * @param $text
     * @return string
     */
    public function doSanitize($text): string
    {
        return kses_split2($text, [
            'img' => []
        ], []);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'Kses';
    }
}

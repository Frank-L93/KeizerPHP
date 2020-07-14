<?php

namespace App\Helpers;

class Path
{
    public static function merge(...$paths): string
    {
        return collect($paths)->map(function (string $path) {
            return trim($path, '/');
        })->implode('/');
    }
}

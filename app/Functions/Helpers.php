<?php

namespace App\Functions;

use Illuminate\Support\Str;

class Helpers
{
    public static function generateSlug(String $title)
    {
        return Str::slug($title, "-");
    }
}

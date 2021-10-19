<?php

namespace App\Libraries;

class Regex
{
    public $regex = [
        'only_num' => '/[^\d]/'
    ];

    public function or(string $val1, string $val2): string
    {
        return "{$val1}|{$val2}";
    }
}

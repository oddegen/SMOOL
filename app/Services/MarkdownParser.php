<?php

namespace App\Services;

use Parsedown;

class MarkdownParser
{
    protected $parsedown;

    public function __construct()
    {
        $this->parsedown = new Parsedown();
    }

    public function parse($text = null)
    {
        if (is_null($text)) {
            return null;
        }

        return $this->parsedown->text($text);
    }
}

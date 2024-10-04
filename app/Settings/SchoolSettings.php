<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SchoolSettings extends Settings
{
    public string $name;
    public string $email;
    public string $phone;
    public string $address;
    public string $info;
    public ?string $logo;
    public ?string $favicon;
    public string $theme;
    public string $batch_prefix;
    public string $section_prefix;
    public int $batch_start;
    public int $batch_end;
    public string $section_suffix_type;
    public string $domain;

    public static function group(): string
    {
        return 'school';
    }
}

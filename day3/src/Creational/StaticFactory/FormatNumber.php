<?php
declare(strict_types=1);

namespace App\Creational\StaticFactory;

class FormatNumber implements Formatter
{
    public function format(string $input): string
    {
        return number_format($input);
    }
}
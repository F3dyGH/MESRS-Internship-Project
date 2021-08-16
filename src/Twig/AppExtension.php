<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('Student', [$this, 'Student']),
        ];
    }
    public function Student(array $roles)
    {
        return $roles ["ROLE_STUD"]; // Replace this by your own check.
    }
}
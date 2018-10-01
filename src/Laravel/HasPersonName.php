<?php

namespace Artisan\NameOfPerson\Laravel;

use Artisan\NameOfPerson\PersonName;

trait HasPersonName
{
    public function getNameAttribute($name)
    {
        return new PersonName($name);
    }
}

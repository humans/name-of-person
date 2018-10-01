<?php

namespace Artisan\NameOfPerson;

use Illuminate\Support\Str;

class PersonName
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function full()
    {
        return $this->name;
    }

    public function first()
    {
        return Str::before($this->name, ' ');
    }

    public function last()
    {
        if (! Str::contains($this->name, ' ')) {
            return null;
        }

        return Str::after($this->name, ' ');
    }

    public function initials()
    {
        preg_match_all('/(?<=\s|^)[A-Z]/', $this->name, $matches);

        return implode('', head($matches));
    }

    public function abbreviated()
    {
        return $this->first()[0] . '. ' . $this->last();
    }

    public function sorted()
    {
        return $this->last() . ', ' . $this->first();
    }

    public function mentionable()
    {
        return strtolower($this->first() . $this->last()[0]);
    }

    public function possessive()
    {
        if (Str::endsWith($this->name, 's')) {
            return $this->name . "'";
        }

        return $this->name . "'s";
    }

    public function familiar()
    {
        return $this->first() . ' ' . strtoupper($this->last()[0]) . '.';
    }

    public function __get($attribute)
    {
        return call_user_func([$this, $attribute]);
    }

    public function __toString()
    {
        return $this->name;
    }

    public function toArray()
    {
        return [
            'full'        => $this->name,
            'first'       => $this->first,
            'last'        => $this->last,
            'initials'    => $this->initials,
            'abbreviated' => $this->abbreviated,
            'sorted'      => $this->sorted,
            'mentionable' => $this->mentionable,
            'possessive'  => $this->possessive,
            'familiar'    => $this->familiar,
        ];
    }
}
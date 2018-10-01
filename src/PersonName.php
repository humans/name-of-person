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

    /**
     * Initial the first name.
     *
     * T. Crews
     *
     * @return string
     */
    public function abbreviated()
    {
        return $this->first()[0] . '. ' . $this->last();
    }

    /**
     * Last name, first name.
     *
     * Crews, Terry
     *
     * @return string
     */
    public function sorted()
    {
        return $this->last() . ', ' . $this->first();
    }

    /**
     * Username-esque.
     *
     * terryc
     *
     * @return string
     */
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

    /**
     * Initial the last name.
     *
     * Terry C.
     *
     * @return string
     */
    public function familiar()
    {
        return $this->first() . ' ' . strtoupper($this->last()[0]) . '.';
    }

    /**
     * Make the methods accessibles as attributes.
     *
     * @param  string  $attribute
     * @return string
     */
    public function __get($attribute)
    {
        return call_user_func([$this, $attribute]);
    }

    /**
     * Let's just use the full name when echoed.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}

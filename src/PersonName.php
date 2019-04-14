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
        return new static($this->name);
    }

    public function first()
    {
        return new static(Str::before($this->name, ' '));
    }

    public function last()
    {
        return new static(Str::after($this->name, ' '));
    }

    public function initials()
    {
        preg_match_all('/(?<=\s|^)[A-Z]/', $this->name, $matches);

        return new static(implode('', head($matches)));
    }

    /**
     * T. Crews
     *
     * @return string
     */
    public function abbreviated()
    {
        return new static(
            sprintf('%.1s. %s', $this->first(), $this->last())
        );
    }

    /**
     * Crews, Terry
     *
     * @return string
     */
    public function sorted()
    {
        return new static($this->last() . ', ' . $this->first());
    }

    /**
     * terryc
     *
     * @return string
     */
    public function mentionable()
    {
        return new static(
            sprintf(
                '%s%.1s',
                strtolower($this->first()),
                strtolower($this->last())
            )
        );
    }

    public function possessive()
    {
        if (Str::endsWith($this->name, 's')) {
            return new static($this->name . "'");
        }

        return new static($this->name . "'s");
    }

    /**
     * Terry C.
     *
     * @return string
     */
    public function familiar()
    {
        return new static(
            sprintf('%s %.1s.', $this->first(), strtoupper($this->last()))
        );
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

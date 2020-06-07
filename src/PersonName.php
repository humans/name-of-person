<?php

namespace Humans\NameOfPerson;

class PersonName
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function full()
    {
        return new self($this->name);
    }

    public function first()
    {
        return new self(
            explode(' ', $this->name)[0]
        );
    }

    public function last()
    {
        $segments = explode(' ', $this->name);
        array_shift($segments);

        if (count($segments) === 0) {
            return new self($this->name);
        }

        return new self(implode(' ', $segments));
    }

    public function initials()
    {
        preg_match_all('/(?<=\s|^)[A-Z]/', $this->name, $matches);

        return new self(implode('', $matches[0]));
    }

    public function abbreviated()
    {
        return new self(
            sprintf('%.1s. %s', $this->first(), $this->last())
        );
    }

    public function sorted()
    {
        return new self($this->last() . ', ' . $this->first());
    }

    public function mentionable()
    {
        return new self(
            sprintf(
                '%s%.1s',
                strtolower($this->first()),
                strtolower($this->last())
            )
        );
    }

    public function possessive()
    {
        if (substr($this->name, -1) === 's') {
            return new self($this->name . "'");
        }

        return new self($this->name . "'s");
    }

    public function familiar()
    {
        return new self(
            sprintf('%s %.1s.', $this->first(), strtoupper($this->last()))
        );
    }

    public function __get($attribute)
    {
        return call_user_func([$this, $attribute]);
    }

    public function __toString()
    {
        return $this->name;
    }
}

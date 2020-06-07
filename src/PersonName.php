<?php

namespace Humans\NameOfPerson;

class PersonName
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function new(string $name): self
    {
        return new static($name);
    }

    public function full(): self
    {
        return new self($this->name);
    }

    public function first(): self
    {
        return new self(
            explode(' ', $this->name)[0]
        );
    }

    public function last(): self
    {
        $segments = explode(' ', $this->name);
        array_shift($segments);

        if (count($segments) === 0) {
            return new self($this->name);
        }

        return new self(implode(' ', $segments));
    }

    public function initials(): self
    {
        preg_match_all('/(?<=\s|^)[A-Z]/', $this->name, $matches);

        return new self(implode('', $matches[0]));
    }

    public function abbreviated(): self
    {
        return new self(
            sprintf('%.1s. %s', $this->first(), $this->last())
        );
    }

    public function sorted(): self
    {
        return new self($this->last() . ', ' . $this->first());
    }

    public function mentionable(): self
    {
        return new self(
            sprintf(
                '%s%.1s',
                strtolower($this->first()),
                strtolower($this->last())
            )
        );
    }

    public function possessive(): self
    {
        if (substr($this->name, -1) === 's') {
            return new self($this->name . "'");
        }

        return new self($this->name . "'s");
    }

    public function familiar(): self
    {
        return new self(
            sprintf('%s %.1s.', $this->first(), strtoupper($this->last()))
        );
    }

    public function __get($attribute): self
    {
        return call_user_func([$this, $attribute]);
    }

    public function __toString(): string
    {
        return $this->name;
    }
}

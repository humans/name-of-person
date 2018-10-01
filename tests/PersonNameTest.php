<?php

use PHPUnit\Framework\TestCase;
use Artisan\NameOfPerson\PersonName;

class PersonNameTest extends TestCase
{
    function test_full_name()
    {
        $name = new PersonName('Terry Crews');

        $this->assertEquals('Terry Crews', $name->full);
    }

    function test_first_name()
    {
        $name = new PersonName('Terry Crews');

        $this->assertEquals('Terry', $name->first);
    }

    function test_last_name()
    {
        $name = new PersonName('Terry Crews');

        $this->assertEquals('Crews', $name->last);
    }

    function test_return_null_when_no_last_name()
    {
        $name = new PersonName('Terry');

        $this->assertEquals('', $name->last);
    }

    function test_initials()
    {
        $name = new PersonName('Terry A. Crews');

        $this->assertEquals('TAC', $name->initials);
    }

    function test_abbreviated_name()
    {
        $name = new PersonName('Terry Crews');

        $this->assertEquals('T. Crews', $name->abbreviated);
    }

    function test_sorted_name()
    {
        $name = new PersonName('Terry Crews');

        $this->assertEquals('Crews, Terry', $name->sorted);
    }

    function test_mentionable_name()
    {
        $name = new PersonName('Terry Crews');

        $this->assertEquals('terryc', $name->mentionable);
    }

    function test_possessive_name()
    {
        $name = new PersonName('Terry Crews');

        $this->assertEquals("Terry Crews'", $name->possessive);

        $name = new PersonName('Melissa Fumero');

        $this->assertEquals("Melissa Fumero's", $name->possessive);
    }

    function test_familiar_name()
    {
        $name = new PersonName('Terry Crews');

        $this->assertEquals("Terry C.", $name->familiar);
    }

    function test_full_name_when_object_cast_as_string()
    {
        $name = new PersonName('Terry Crews');

        $this->assertEquals('Terry Crews', (string) $name);
    }
}

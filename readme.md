# Name of Person

A port of [Basecamp's name of person library](https://github.com/basecamp/name_of_person).

A library to make an much more expressive breakdown of a user's name.

This is a pretty simplified library without accounting for any of the edge cases of how names are handled, just something usable where everything _after_ the first name is treated as the last name.

## Installation

```bash
composer require artisan/name-of-person
```

## Usage

```php
use Artisan\NameOfPerson\PersonName;

$name = new PersonName('Terry Crews');

$name->full;        // => "Terry Crews"
$name->first;       // => "Terry"
$name->last;        // => "Crews"
$name->initials;    // => "TC"
$name->familiar;    // => "Terry C."
$name->abbreviated; // => "T. Crews"
$name->sorted;      // => "Crews, Terry"
$name->mentionable; // => "terryc"
$name->possessive;  // => "Terry Crews'"
```

## The Laravel Trait has been removed!

I ended up not using the trait since there are projects that I wanted to use a different key for the name. Instead, if you want to use the library, I highly suggest using a different attribute to avoid conflicts when building JSON APIs.

```php
use Artisan\NameOfPerson\PersonName;

class User
{
    public function getNameAttribute()
    {
        return new PersonName($this->attributes['full_name']);
    }
}
```
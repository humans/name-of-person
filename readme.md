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

If you want to use it with a Laravel model, we've also provided a trait for that.

```php
use Artisan\NameOfPerson\Laravel\HasPersonName;

class Person extends Model
{
    use HasPersonName;
}
```

## Todo

There's still some cases that we'd want to cover such as users only providing single names.

We don't really want to plan on supporting complex naming rules, so feel free to fork the project if you want to add more functionality.

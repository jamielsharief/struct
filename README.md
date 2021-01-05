# Struct

![license](https://img.shields.io/badge/license-MIT-brightGreen.svg)
[![build](https://github.com/jamielsharief/struct/workflows/CI/badge.svg)](https://github.com/jamielsharief/struct/actions)
[![coverage status](https://coveralls.io/repos/github/jamielsharief/struct/badge.svg?branch=main)](https://coveralls.io/github/jamielsharief/struct?branch=main)


## Defining a Struct

Create a class that defines the properties.

```php
use Struct\Struct;

class Contact extends Struct
{
    public string $name;
    public string $company;
    public string $email;
    public int $age;
    public bool $unsubscribed = false;
}
```

### Creating an Struct Object

Create and work with the Object as you normally would

```php
$contact = new Contact();
$contact->name = 'Jon';
$contact->email = 'jonny@example.com';
```

You can also mass set properties by passing an array to constructor.

```php
$contact = new Contact([
    'name' => 'Jon',
    'company' => 'Snow Enterprises',
    'email' => 'jon@example.com',
    'age' => 33
]);
```

### Exception Handling

If you try to set or get a property that does not exist, a `RuntimeException` will be thrown.

### Cloning

When `Structs` are cloned, any properties which are objects or arrays which contain objects will also be cloned.

### Initialize Hook

When the `Struct` is constructed it will call `initialize` method if it is available, this is a hook incase
you need to override the constructor.
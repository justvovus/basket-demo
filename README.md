I was trying to do not go too abstract, but to keep it usable and extendable.
Like a balance between a dummy project and a real life code.

In PHP 8.1 some code can be simplified using readonly class properties.

I assumed that the basket may have multiple special offers being applicable, but only one delivery strategy being selected.

###How to test:
```php
composer install
./vendor/bin/phpunit ./tests/
```

###Use as dependency with composer
Append your project's composer.json "require" and "repositories" following this example:
```json
{
  "require": {
    "widget/basket": "*"
  },
  "repositories": [
    {
      "type": "path",
      "url": "../widget"
    }
  ]
}
```

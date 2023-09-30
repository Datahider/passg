# A Password Generator

## Simple Usage

```php
use losthost\passg\Pass;

$new_password = Pass::generate();
```

It will generate a 14-symbol (it is max for Windows) password, that will not 
contain ambiguous symbols like 1 and l, O ans 0 etc. Also it will (or will not)
contain only `_` as a special symbol (to simplify highligting the password by
double click).

## More complex usage

```php
use losthost\passg\Pass;

$new_password = Pass::generate(4, '0123456789');
```

It will generate a 4-digit password (eg. a pin-code)

## TODO

- add additional parameters to generate passwords that <u>must</u> contain symbols from different classes
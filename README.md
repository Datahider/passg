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

## Very complex usage

```php
use losthost\passg\Pass;

// Generate a 14-symbol password that contains at least 1 symbol of each class
$new_password_1 = Pass::generate(14, [
    Pass::ALL_LOWERCASE,
    Pass::ALL_UPPERCASE,
    Pass::ALL_DIGITS,
    Pass::ALL_SYMBOLS
]); 
        // ex. P3H{nh"/|S2.?|

// Generate a 10-symbol password that contains at least 3 digits and 3 lowercase letters
$new_password_2 = Pass::generate(10, [
    Pass::CLEAN_DIGITS, 
    Pass::CLEAN_LOWERCASE
], 3); 
        // ex. 6kf5czqi86

// Generate a 4-digits password that contain at least 2 `5`
$new_password_3 = Pass::generate(4, [
    '012346789', '5'
], 2); 
        // ex. 5751
```

## TODO

Now it seems nothing to do

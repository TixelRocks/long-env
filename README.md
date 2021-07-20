# long-env
[![Build Status](https://travis-ci.org/tixelrocks/long-env.svg)](https://travis-ci.org/tixelrocks/long-env)
[![Total Downloads](https://poser.pugx.org/tixelrocks/long-env/d/total.svg)](https://packagist.org/packages/tixelrocks/long-env)
[![Latest Stable Version](https://poser.pugx.org/tixelrocks/long-env/v/stable.svg)](https://packagist.org/packages/tixelrocks/long-env)
[![Latest Unstable Version](https://poser.pugx.org/tixelrocks/long-env/v/unstable.svg)](https://packagist.org/packages/tixelrocks/long-env)
[![License](https://poser.pugx.org/tixelrocks/class-constants-helper/license.svg)](https://packagist.org/packages/tixelrocks/long-env)

An env() alternative that works with long multi-line environment variables in places where it's not possible to do
so natively - eg. AWS Elastic Beanstalk

Imagine you want to run Laravel Passport in AWS so you need to pass your private key as a PASSPORT_PRIVATE_KEY
environment variable but hey 1) AWS doesn't allow multi-line environment variables 2) AWS has a limit of 4096 character
per environment variable.

So you end up getting an annoying error like this:

```
Service:AmazonCloudFormation, Message:Template format error: Parameter 'EnvironmentVariables' default value '[****]' length is greater than 4096.
```

# Solution

Our solution is simple, go to `config/passport.php` and replace

```php
<?php 
return [
    'private_key' => env('PASSPORT_PRIVATE_KEY')
];
```

with:

```php
return [
    'private_key' => long_env('PASSPORT_PRIVATE_KEY')
];
```

And now pass your long variable as numbered chunks instead of one super long string:

```bash
PASSPORT_PRIVATE_KEY1=
PASSPORT_PRIVATE_KEY2=
PASSPORT_PRIVATE_KEY3=
# and so on
```

The `long_env()` function will magically combine them together for you. If you need help making the
chunks, just use the `long_env_prepare()` function provided with this package:

```php
<?php
  print_r(long_env_prepare('SUPER LONG STRING'));
```
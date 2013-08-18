Scrutiny
=======

An agnostic monitoring system written in PHP. You can Scrutiny any service, and report to any other service.


## Example

```php

<?php

include dirname(__DIR__) . '/vendor/autoload.php';

$scrutiny = new \Scottymeuk\Scrutiny\Client(
    'example.com',
    array(
        new \Scottymeuk\Scrutiny\Service\MySQL(array(
            'host' => 'localhost',
            'username' => 'username',
            'password' => 'password',
            'port' => 3306
        )),
        new \Scottymeuk\Scrutiny\Service\MongoDB(),
    ),
    array(
        new \Scottymeuk\Scrutiny\Reporter\Pushover(
            'token',
            'user'
        )
    )
);

$scrutiny->watch();

```

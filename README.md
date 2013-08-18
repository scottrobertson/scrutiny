Monitor
=======

An agnostic monitoring system written in PHP. You can monitor any service, and report to any other service.


## Example

```php

<?php

include dirname(__DIR__) . '/vendor/autoload.php';

$monitor = new \Scottymeuk\Monitor\Client(
    'example.com',
    array(
        new \Scottymeuk\Monitor\Service\MySQL(array(
            'host' => 'localhost',
            'username' => 'username',
            'password' => 'password',
            'port' => 3306
        )),
        new \Scottymeuk\Monitor\Service\MongoDB(),
    ),
    array(
        new \Scottymeuk\Monitor\Reporter\Pushover(
            'token',
            'user'
        )
    )
);

$monitor->watch();

```

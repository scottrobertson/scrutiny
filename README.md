Scrutiny
=======

An agnostic monitoring system written in PHP. You can monitor any service, and report it anywhere (pushover.net for example) it if goes down.

## Example

```php

<?php
include __DIR__ . '/vendor/autoload.php';
$scrutiny = new \Scottymeuk\Scrutiny\Client('example.com');

// Monitor google.com, MySQL and MongoDB's status
$scrutiny->addService(new \Scottymeuk\Scrutiny\Service\Url('http://www.google.com'));
$scrutiny->addService(new \Scottymeuk\Scrutiny\Service\MongoDB());
$scrutiny->addService(
    new \Scottymeuk\Scrutiny\Service\MySQL(
        array(
            'host' => 'localhost',
            'username' => 'username',
            'password' => 'password',
            'port' => 3306
        )
    )
);

// Send notifications to pushover.net
$scrutiny->addReporter(
    new \Scottymeuk\Scrutiny\Reporter\Pushover(
        'token',
        'user'
    )
);

$scrutiny->watch(5);

```

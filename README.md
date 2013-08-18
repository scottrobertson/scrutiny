Scrutiny
=======

An agnostic monitoring system written in PHP. You can monitor any Service, and report it anywhere (pushover.net for example) it if goes down.

Each [Reporter](https://github.com/scottrobertson/scrutiny/wiki/Reporter) can subscribe to [Events](https://github.com/scottrobertson/scrutiny/wiki/Events) from [Services](https://github.com/scottrobertson/scrutiny/wiki/Service). There are 3 events: **up**, **down**, and **recovery**. Services can collect any meta data they want, and Reporters will have access to this data. This allows you to collect stats for instance.

## Install

```json
{
    "require" : {
        "scottrobertson/scrutiny" : "dev-master"
    }
}
```

```php

<?php
include __DIR__ . '/vendor/autoload.php';
$scrutiny = new \ScottRobertson\Scrutiny\Client('example.com');

// Monitor google.com, MySQL and MongoDB's status
$scrutiny->addService(new \ScottRobertson\Scrutiny\Service\Url('http://www.google.com'));
$scrutiny->addService(new \ScottRobertson\Scrutiny\Service\MongoDB());
$scrutiny->addService(
    new \ScottRobertson\Scrutiny\Service\MySQL(
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
    new \ScottRobertson\Scrutiny\Reporter\Pushover(
        'token',
        'user'
    )
);

$scrutiny->watch(5);

```

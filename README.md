Scrutiny
=======

[![Build Status](https://travis-ci.org/scottrobertson/scrutiny.png?branch=master)](https://travis-ci.org/scottrobertson/scrutiny)
[![Dependency Status](https://www.versioneye.com/user/projects/52111318632bac39a200ac50/badge.png)](https://www.versioneye.com/user/projects/52111318632bac39a200ac50)
[![Version](https://poser.pugx.org/scottrobertson/scrutiny/version.png)](https://packagist.org/packages/scottrobertson/scrutiny)
[![Downloads](https://poser.pugx.org/scottrobertson/scrutiny/d/total.png)](https://packagist.org/packages/scottrobertson/scrutiny)


An agnostic monitoring system written in PHP. Monitor any service, and report on it's status.

Each [Reporter](https://github.com/scottrobertson/scrutiny/wiki/Reporter) can subscribe to [Events](https://github.com/scottrobertson/scrutiny/wiki/Events) from [Services](https://github.com/scottrobertson/scrutiny/wiki/Service). There are 3 events: **up**, **down**, and **recovery**. Services can collect any meta data they want, and Reporters will have access to this data. This allows you to collect stats for instance.

### Install

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

// Setup Services to monitor
$scrutiny->addService(new \ScottRobertson\Scrutiny\Service\Http('http://example.com'));

// Set options on a service
$mongodb = new \ScottRobertson\Scrutiny\Service\MongoDB();
$mongodb->setName('MongoDB');
$mongodb->setInterval(20);
$mongodb->setDownMessage('ER MER GERD MORGOR ER DORN');
$scrutiny->addService($mongodb);

// Setup Reporters
$scrutiny->addReporter(new \ScottRobertson\Scrutiny\Reporter\Post('http://api.example.com'));
$scrutiny->addReporter(
    new \ScottRobertson\Scrutiny\Reporter\Pushover(
        'token',
        'user'
    )
);

$scrutiny->watch(5);
```

### Current Services
 - MySQL
 - MongoDB
 - Http (Checking if a website is available)

### Current Reporters
 - Pushover.net
 - Post

### Example Use case
For example, if you wanted to monitor MySQL, you could setup the Pushover Reporter to subscribe to "down" events. This would mean that if MySQL went down, you would receive a push notification.

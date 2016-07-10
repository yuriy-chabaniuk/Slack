# Slack
Simple API to comunicat with Slack

## Installation

```sh
composer require ychabaniuk/slack
```

## Create Web Hook Instance

```php

use Ychabaniuk\Slack\IncomingWebHook;

/* Create single Web Hook instance */
$webHook = new IncomingWebHook('https://hooks.slack.com/services/...');

/*
* channel => #chanelname; @username;
*/

$webHook = new IncomingWebHook('https://hooks.slack.com/services/...' , [
    'username' => 'Jim'
    'channel' => '#general',
    'icon' => ':emoji:'
]);
```

You can see default configs in ([Incoming Web Hook](https://api.slack.com/incoming-webhooks)) documentation.

## Sending message.

```php
$webHook->text('The new task was created!')->send();
```

### Sending a message to the user.
```php
$webHook->to('@username')
    ->text('The new task was assigned to you!')
    ->send();
```

### Sending message.
```php
$webHook->from('Notification Manager')
    ->to('@username')
    ->icon('http://site.com/img.png')
    ->text('New Emergency ticket created.')
    ->send();
```

### Sending message with attachment

```php
$webHook->to('#general')
    ->text('The new task was created!')
    ->attach([
        "fallback": "Required plain-text summary of the attachment.",
        "color": "#36a64f",
        "pretext": "Optional text that appears above the attachment block",
        "author_name": "Bobby Tables"
    ])->send();
```

### Sending message with attachments and fields.

```php

use Ychabaniuk\Slack\Attachment;

$attach = Attachment::make()
    ->field([
        'title' => "Title",
        'value' => 'Value ',
        'short' => true,
    ])->field([
        'title' => "Title",
        'value' => 'Value ',
        'short' => true,
    ]);

$webHook = new IncomingWebHook('https://hooks.slack.com/services/...' , [
    'username' => 'Jim'
    'channel' => '#general',
    'icon' => ':emoji:'
]);

$webHook->attach($attach);

$webHook->text('Message!')
    ->send();
```

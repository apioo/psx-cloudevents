PSX CloudEvents
===

## About

Library which helps to produce and consume cloud events s. https://github.com/cloudevents/spec

### Produce

To create a CloudEvent object you can use the builder i.e.:

```php
<?php

$event = (new Builder())
    ->withType('com.example.someevent')
    ->withSource('/mycontext')
    ->withId('1234-1234-1234')
    ->withTime(new \DateTime('2018-04-05T17:31:00Z'))
    ->withDataContentType('application/json')
    ->withData(['foo' => 'bar'])
    ->withExtension('bar', 'foo')
    ->build();

```

Then it is possible to JSON serialize the event which produces the following JSON output:

```json
{
    "specversion": "1.0",
    "type": "com.example.someevent",
    "source": "\/mycontext",
    "id": "1234-1234-1234",
    "time": "2018-04-05T17:31:00+00:00",
    "datacontenttype": "application\/json",
    "data": {
        "foo": "bar"
    },
    "bar": "foo"
}
```

### Consume

To create a CloudEvent object from raw JSON data you can use the parser:

```php
<?php

$json = '{ ... }';
$event = Parser::parse(json_decode($json));

assert('1.0' === $event->getSpecVersion());
assert('com.example.someevent' === $event->getType());
assert('/mycontext' === $event->getSource());
assert('1234-1234-1234' === $event->getId());
assert($event->getTime() instanceof \DateTimeInterface::class);
assert('Thu, 05 Apr 2018 17:31:00 +0000' === $event->getTime()->format('r'));
assert('application/json' === $event->getDataContentType());
assert(['foo' => 'bar'] === $event->getData());
assert(['bar' => 'foo'] === $event->getExtensions());

```

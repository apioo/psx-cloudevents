<?php
/*
 * PSX is an open source PHP framework to develop RESTful APIs.
 * For the current version and information visit <https://phpsx.org>
 *
 * Copyright 2010-2022 Christoph Kappestein <christoph.kappestein@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace PSX\CloudEvents\Tests;

use PHPUnit\Framework\TestCase;
use PSX\CloudEvents\Builder;
use PSX\CloudEvents\CloudEvent;
use PSX\CloudEvents\Parser;

/**
 * BuilderTest
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    https://phpsx.org
 */
class BuilderTest extends TestCase
{
    public function testBuild()
    {
        $event = (new Builder())
            ->withType('com.example.someevent')
            ->withSource('/mycontext')
            ->withId('1234-1234-1234')
            ->withTime(new \DateTime('2018-04-05T17:31:00Z'))
            ->withDataContentType('application/json')
            ->withData(['foo' => 'bar'])
            ->withExtension('bar', 'foo')
            ->build();

        $actual = \json_encode($event, JSON_PRETTY_PRINT);
        $expect = <<<JSON
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
JSON;

        $this->assertJsonStringEqualsJsonString($expect, $actual, $actual);
    }
}

<?php
/*
 * PSX is a open source PHP framework to develop RESTful APIs.
 * For the current version and informations visit <http://phpsx.org>
 *
 * Copyright 2010-2020 Christoph Kappestein <christoph.kappestein@gmail.com>
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
use PSX\CloudEvents\CloudEvent;
use PSX\CloudEvents\Parser;

/**
 * ParserTest
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class ParserTest extends TestCase
{
    public function testParse()
    {
        $body = [
            'specversion' => '1.0',
            'type' => 'com.example.someevent',
            'source' => '/mycontext',
            'id' => '1234-1234-1234',
            'time' => '2018-04-05T17:31:00Z',
            'datacontenttype' => 'application/json',
            'data' => [
                'foo' => 'bar',
            ],
            'bar' => 'foo'
        ];

        $event = Parser::parse($body);

        $this->assertInstanceOf(CloudEvent::class, $event);
        $this->assertEquals('1.0', $event->getSpecVersion());
        $this->assertEquals('com.example.someevent', $event->getType());
        $this->assertEquals('/mycontext', $event->getSource());
        $this->assertEquals('1234-1234-1234', $event->getId());
        $this->assertInstanceOf(\DateTimeInterface::class, $event->getTime());
        $this->assertEquals('Thu, 05 Apr 2018 17:31:00 +0000', $event->getTime()->format('r'));
        $this->assertEquals('application/json', $event->getDataContentType());
        $this->assertEquals(['foo' => 'bar'], $event->getData());
        $this->assertEquals(['bar' => 'foo'], $event->getExtensions());
    }
}

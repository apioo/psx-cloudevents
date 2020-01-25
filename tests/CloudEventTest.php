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

/**
 * CloudEventTest
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class CloudEventTest extends TestCase
{
    public function testJsonSerialize()
    {
        $cloud = new CloudEvent();
        $cloud->setType('com.example.someevent');
        $cloud->setSource('/mycontext/4');
        $cloud->setId('B234-1234-1234');
        $cloud->setTime(new \DateTime('2018-04-05T17:31:00Z'));
        $cloud->addExtension('comexampleextension1', 'value');
        $cloud->addExtension('comexampleothervalue', 5);
        $cloud->setDataContentType('application/vnd.apache.thrift.binary');
        $cloud->setDataBase64('... base64 encoded string ...');

        $actual = \json_encode($cloud, JSON_PRETTY_PRINT);
        $expect = <<<JSON
{
    "specversion": "1.0",
    "type": "com.example.someevent",
    "source": "\/mycontext\/4",
    "id": "B234-1234-1234",
    "time": "2018-04-05T17:31:00+00:00",
    "datacontenttype": "application\/vnd.apache.thrift.binary",
    "data_base64": "... base64 encoded string ...",
    "comexampleextension1": "value",
    "comexampleothervalue": 5
}
JSON;

        $this->assertJsonStringEqualsJsonString($expect, $actual, $actual);
    }
}

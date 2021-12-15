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

namespace PSX\CloudEvents;

/**
 * Builder
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    https://phpsx.org
 */
class Builder
{
    private CloudEvent $event;

    public function __construct()
    {
        $this->event = new CloudEvent();
    }

    public function withType(string $type): self
    {
        $this->event->setType($type);
        return $this;
    }

    public function withSource(string $source): self
    {
        $this->event->setSource($source);
        return $this;
    }

    public function withId(string $id): self
    {
        $this->event->setId($id);
        return $this;
    }

    public function withTime(\DateTimeInterface $time): self
    {
        $this->event->setTime($time);
        return $this;
    }

    public function withDataContentType(string $contentType): self
    {
        $this->event->setDataContentType($contentType);
        return $this;
    }

    public function withData($data): self
    {
        $this->event->setData($data);
        return $this;
    }

    public function withExtensions(array $extensions): self
    {
        $this->event->setExtensions($extensions);
        return $this;
    }

    public function withExtension(string $name, mixed $value): self
    {
        $this->event->addExtension($name, $value);
        return $this;
    }

    public function build(): CloudEvent
    {
        return clone $this->event;
    }
}

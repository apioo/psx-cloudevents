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

namespace PSX\CloudEvents;

/**
 * CloudEvent
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link    http://phpsx.org
 */
class CloudEvent implements \JsonSerializable
{
    private string $specVersion;
    private ?string $type = null;
    private ?string $source = null;
    private ?string $id = null;
    private ?\DateTimeInterface $time = null;
    private ?string $dataContentType = null;
    private mixed $data = null;
    private ?string $dataBase64 = null;
    private ?array $extensions = null;

    public function __construct()
    {
        $this->specVersion = '1.0';
    }

    public function getSpecVersion(): ?string
    {
        return $this->specVersion;
    }

    public function setSpecVersion(string $specVersion): void
    {
        $this->specVersion = $specVersion;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): void
    {
        $this->time = $time;
    }

    public function getDataContentType(): ?string
    {
        return $this->dataContentType;
    }

    public function setDataContentType(string $dataContentType): void
    {
        $this->dataContentType = $dataContentType;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    public function getDataBase64(): ?string
    {
        return $this->dataBase64;
    }

    public function setDataBase64(string $dataBase64): void
    {
        $this->dataBase64 = $dataBase64;
    }

    public function getExtensions(): ?array
    {
        return $this->extensions;
    }

    public function setExtensions(array $extensions): void
    {
        $this->extensions = $extensions;
    }

    public function addExtension(string $name, mixed $value)
    {
        if (!isset($this->extensions)) {
            $this->extensions = [];
        }

        $this->extensions[$name] = $value;
    }

    public function getExtension(string $name): mixed
    {
        return $this->extensions[$name] ?? null;
    }

    public function jsonSerialize()
    {
        return array_filter(array_merge([
            'specversion' => $this->specVersion,
            'type' => $this->type,
            'source' => $this->source,
            'id' => $this->id,
            'time' => $this->time instanceof \DateTimeInterface ? $this->time->format(\DateTime::RFC3339) : null,
            'datacontenttype' => $this->dataContentType,
            'data' => $this->data,
            'data_base64' => $this->dataBase64,
        ], $this->extensions ?? []), function($value) {
            return $value !== null;
        });
    }
}

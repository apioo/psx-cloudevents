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
    /**
     * @var string
     */
    protected $specVersion;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @var string
     */
    protected $dataContentType;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var mixed
     */
    protected $dataBase64;

    /**
     * @var array
     */
    protected $extensions;

    public function __construct()
    {
        $this->specVersion = '1.0';
    }

    /**
     * @return string
     */
    public function getSpecVersion(): ?string
    {
        return $this->specVersion;
    }

    /**
     * @param string $specVersion
     */
    public function setSpecVersion(string $specVersion): void
    {
        $this->specVersion = $specVersion;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    /**
     * @param \DateTimeInterface $time
     */
    public function setTime(\DateTimeInterface $time): void
    {
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getDataContentType(): ?string
    {
        return $this->dataContentType;
    }

    /**
     * @param string $dataContentType
     */
    public function setDataContentType(string $dataContentType): void
    {
        $this->dataContentType = $dataContentType;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getDataBase64()
    {
        return $this->dataBase64;
    }

    /**
     * @param mixed $dataBase64
     */
    public function setDataBase64($dataBase64): void
    {
        $this->dataBase64 = $dataBase64;
    }

    /**
     * @return array
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }

    /**
     * @param array $extensions
     */
    public function setExtensions(array $extensions): void
    {
        $this->extensions = $extensions;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function addExtension(string $name, $value)
    {
        if (!isset($this->extensions)) {
            $this->extensions = [];
        }

        $this->extensions[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getExtension(string $name)
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

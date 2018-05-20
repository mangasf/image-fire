<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\Models;

final class Image
{
    private $id;
    private $name;
    private $contain;
    private $description;
    private $tags;

    public function __construct(string $id, string $name, string $contain, string $description, string $tags)
    {
        $this->id = $id;
        $this->name = $name;
        $this->contain = $contain;
        $this->description = $description;
        $this->tags = $tags;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContain(): string
    {
        return $this->contain;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTags(): string
    {
        return $this->tags;
    }
}
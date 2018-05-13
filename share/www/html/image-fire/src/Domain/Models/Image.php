<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\Models;

final class Image
{
    private $id;
    private $name;
    private $contain;

    public function __construct(int $id, string $name, string $contain)
    {
        $this->id = $id;
        $this->name = $name;
        $this->contain = $contain;
    }

    public function getId(): int
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
}
<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\Models;

final class Image
{
    private $name;
    private $contain;

    public function __construct(string $name, string $contain)
    {
        $this->name = $name;
        $this->contain = $contain;
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
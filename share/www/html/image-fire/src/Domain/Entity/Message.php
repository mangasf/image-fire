<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\Entity;

final class Message
{
    protected $action;
    protected $src_image;
    protected $dist_image;

    public function __construct(
        string $action,
        string $src_image,
        string $dist_image
    )
    {
        $this->action = $action;
        $this->src_image = $src_image;
        $this->dist_image = $dist_image;
    }

    public function action(): string
    {
        return $this->action;
    }

    public function srcImage(): string
    {
        return $this->src_image;
    }

    public function distImage(): string
    {
        return $this->dist_image;
    }
}
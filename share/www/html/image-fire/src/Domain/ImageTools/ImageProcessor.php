<?php

declare(strict_types = 1);

namespace Mangasf\ImageFire\Domain\ImageTools;

interface ImageProcessor
{
    public function resizeToHeight(string $imageSource, int $height, string $imageDestination): void;
    public function resizeToWidth(string $imageSource, int $width, string $imageDestination): void;
}
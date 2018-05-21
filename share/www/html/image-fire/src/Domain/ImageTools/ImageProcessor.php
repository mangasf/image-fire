<?php

declare(strict_types = 1);

namespace Mangasf\ImageFire\Domain\ImageTools;

interface ImageProcessor
{
    public function resizeToHeight(string $imageSource, int $height, string $imageDestination): void;
    public function resizeToWidth(string $imageSource, int $width, string $imageDestination): void;
    public function cropImage(string $imageSource, int $height, int $width, string $imageDestination): void;
    public function addFilter(string $imageSource, string $imageDestination, string $filter): void;
    public function scaleImage(string $imageSource, int $scale, string $imageDestination): void;
}
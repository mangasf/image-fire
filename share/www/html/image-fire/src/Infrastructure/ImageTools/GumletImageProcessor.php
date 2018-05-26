<?php

namespace Mangasf\ImageFire\Infrastructure\ImageTools;

use Gumlet\ImageResize;
use Mangasf\ImageFire\Domain\ImageTools\ImageProcessor;

final class GumletImageProcessor implements ImageProcessor
{
    public function resizeToHeight(string $imageSource, int $height, string $imageDestination): void
    {
        $image = new ImageResize($imageSource);
        $image->resizeToHeight($height);
        $image->save($imageDestination);
    }

    public function resizeToWidth(string $imageSource, int $width, string $imageDestination): void
    {
        $image = new ImageResize($imageSource);
        $image->resizeToWidth($width);
        $image->save($imageDestination);
    }
}
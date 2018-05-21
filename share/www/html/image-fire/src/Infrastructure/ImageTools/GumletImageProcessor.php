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

    public function cropImage(string $imageSource, int $height, int $width, string $imageDestination): void
    {
        $image = new ImageResize($imageSource);
        $image->crop($width, $height);
        $image->save($imageDestination);
    }

    public function addFilter(string $imageSource, string $imageDestination, string $filter): void
    {
        $image = new ImageResize($imageSource);

        $image->addFilter(function ($imageDesc) {
            imagefilter($imageDesc, IMG_FILTER_GAUSSIAN_BLUR);
        });

        $image->save($imageDestination);
    }

    public function scaleImage(string $imageSource, int $scale, string $imageDestination): void
    {
        $image = new ImageResize($imageSource);
        $image->scale($scale);
        $image->save($imageDestination);
    }
}
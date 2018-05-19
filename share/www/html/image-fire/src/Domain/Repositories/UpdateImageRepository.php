<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\Repositories;

use Mangasf\ImageFire\Domain\Models\Image;

interface UpdateImageRepository
{
    public function updateImage(Image $image);
}
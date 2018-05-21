<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\Repositories;

use Mangasf\ImageFire\Domain\Models\Image;

interface InitializeRepo
{
    public function initializeRepo(Image ...$images);
}
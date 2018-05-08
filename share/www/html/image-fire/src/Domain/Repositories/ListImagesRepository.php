<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain;

interface ListImagesRepository
{
    public function getAllImages(): array;
}
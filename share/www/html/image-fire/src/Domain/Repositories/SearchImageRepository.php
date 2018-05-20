<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\Repositories;

interface SearchImageRepository
{
    public function searchImages(string $searchCritrials): array;
}
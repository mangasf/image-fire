<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Application\Service;

use Mangasf\ImageFire\Domain\Repositories\SearchImageRepository;
use PDOException;

final class SearchImages
{
    private $repoImageSearcher;

    public function __construct(SearchImageRepository $repoImageSearcher)
    {
        $this->repoImageSearcher = $repoImageSearcher;
    }

    public function __invoke(string $searchCriterials)
    {
        try {
            return $this->repoImageSearcher->searchImages($searchCriterials);
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }
}
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'autoload.php';

use Mangasf\ImageFire\Application\Service\ListImages;
use Mangasf\ImageFire\Application\Service\SearchImages;
use Mangasf\ImageFire\Infrastructure\Repositories\Elastic\SearchImagesElastic;
use Mangasf\ImageFire\Infrastructure\Repositories\MySql\ListImagesMysql;

if (isset($_POST['Search'])) {
    $searchInput = $_POST['searchInput'];
    $searchRepo = new SearchImagesElastic();
    $imagesSearcher = new SearchImages($searchRepo);
    $imagesList = $imagesSearcher($searchInput);
} else {
    $listRepo = new ListImagesMysql();
    $imagesLister = new ListImages($listRepo);
    $imagesList = $imagesLister();
}

echo $twig->render('index.twig',
    [
        'images' => $imagesList
    ]
);


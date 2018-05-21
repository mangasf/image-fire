<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'autoload.php';

use Mangasf\ImageFire\Application\Service\ListImages;
use Mangasf\ImageFire\Application\Service\SearchImages;
use Mangasf\ImageFire\Infrastructure\Repositories\Elastic\SearchImagesElastic;
use Mangasf\ImageFire\Infrastructure\Repositories\MySql\ListImagesMysql;
use Mangasf\ImageFire\Infrastructure\Repositories\Redis\InitializeRedis;
use Mangasf\ImageFire\Infrastructure\Repositories\Redis\ListImagesRedis;

if (isset($_POST['Search'])) {
    $searchInput = $_POST['searchInput'];
    $searchRepo = new SearchImagesElastic();
    $imagesSearcher = new SearchImages($searchRepo);
    $imagesList = $imagesSearcher($searchInput);

} else {

    $listRepoRedis = new ListImagesRedis();
    $imageListerRedis = new ListImages($listRepoRedis);
    $imagesList = $imageListerRedis();

    if(sizeof($imagesList) == 0) {
        $listRepo = new ListImagesMysql();
        $imagesLister = new ListImages($listRepo);
        $imagesList = $imagesLister();
        $initializeRedis = new InitializeRedis();
        $initializeRedis->initializeRepo(...$imagesList);
    }
}

echo $twig->render('index.twig',
    [
        'images' => $imagesList
    ]
);


<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'autoload.php';

use Mangasf\ImageFire\Application\Service\ListImages;
use Mangasf\ImageFire\Infrastructure\Repositories\ListImagesMysql;

$listRepo = new ListImagesMysql();
$imagesLister = new ListImages($listRepo);
$imagesList = $imagesLister();

echo $twig->render('index.twig',
    [
        'images' => $imagesList
    ]
);


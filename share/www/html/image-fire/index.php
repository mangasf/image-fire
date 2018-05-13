<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require 'autoload.php';

use Mangasf\ImageFire\Application\Service\ListImages;
use Mangasf\ImageFire\Infrastructure\Repositories\ListImagesMysql;

$listRepo = new ListImagesMysql();
$imagesLister = new ListImages($listRepo);
$imagesList = $imagesLister();

echo $twig->render('index.twig',
    [
        'images' => $imagesList
    ]);


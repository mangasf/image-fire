<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../autoload.php';

use Mangasf\ImageFire\Application\Service\DeleteImage;
use Mangasf\ImageFire\Infrastructure\Repositories\Elastic\DeleteImageElastic;
use Mangasf\ImageFire\Infrastructure\Repositories\MySql\DeleteImageMysql;
use Mangasf\ImageFire\Infrastructure\Repositories\Redis\DeleteImageRedis;

if ($_POST) {

    $imageId = $_POST['id'];

    $deleteImageRepoMysql = new DeleteImageMysql();
    $deleteImageRepoElastic = new DeleteImageElastic();
    $deleteImageRepoRedis = new DeleteImageRedis();

    $deleteImageMysql = new DeleteImage($deleteImageRepoMysql);
    $deleteImageElastic = new DeleteImage($deleteImageRepoElastic);
    $deleteImageRedis = new DeleteImage($deleteImageRepoRedis);

    try {
        $deleteImageMysql($imageId);
        $deleteImageElastic($imageId);
        $deleteImageRedis($imageId);

        echo $twig->render('notification.twig',
            [
                'type' => 'success',
                'message' => 'The image has been successfully eliminated.'
            ]
        );
    } catch (PDOException $exception) {
        $message = $exception->getMessage();
        echo $twig->render('notification.twig',
            [
                'type' => 'success',
                'message' => 'The image could not be deleted.' . $message
            ]
        );
    }
}
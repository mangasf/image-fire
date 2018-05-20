<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../autoload.php';

use Mangasf\ImageFire\Application\Service\DeleteImage;
use Mangasf\ImageFire\Infrastructure\Repositories\Elastic\DeleteImageElastic;
use Mangasf\ImageFire\Infrastructure\Repositories\MySql\DeleteImageMysql;

if ($_POST) {

    $imageId = $_POST['id'];

    $deleteImageRepoMysql = new DeleteImageMysql();
    $deleteImageRepoElastic = new DeleteImageElastic();
    $deleteImageMysql = new DeleteImage($deleteImageRepoMysql);
    $deleteImageElastic = new DeleteImage($deleteImageRepoElastic);

    try {
        $deleteImageMysql($imageId);
        $deleteImageElastic($imageId);
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
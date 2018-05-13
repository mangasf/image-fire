<?php

require 'autoload.php';

use Mangasf\ImageFire\Application\Service\DeleteImage;
use Mangasf\ImageFire\Infrastructure\Repositories\DeleteImageMysql;

if ($_POST) {

    $imageId = (int)$_POST['id'];

    $deleteImageRepo = new DeleteImageMysql();
    $deleteImage = new DeleteImage($deleteImageRepo);

    try {
        $deleteImage($imageId);
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
                'message' => 'The image has been successfully eliminated.' . $message
            ]
        );
    }
}
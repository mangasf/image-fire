<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../autoload.php';

if ($_POST) {

    $imageId = $_POST['id'];
    $imageName = $_POST['name'];
    $imageContain = $_POST['contain'];
    $imageDescription = $_POST['description'];
    $imageTags = $_POST['tags'];

    try {

        echo $twig->render('form-edit.twig',
            [
                'imageId' => $imageId,
                'imageName' => $imageName,
                'imageContain' => $imageContain,
                'imageDescription' => $imageDescription,
                'imageTags' => $imageTags
            ]
        );
    } catch (PDOException $exception) {
        $message = $exception->getMessage();
        echo $twig->render('notification.twig',
            [
                'type' => 'success',
                'message' => 'The image could not be updated.' . $message
            ]
        );
    }
}
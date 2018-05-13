<?php

require '../../autoload.php';

if ($_POST) {

    $imageId = (int)$_POST['id'];
    $imageName = $_POST['name'];
    $imageDescription = $_POST['desc'];
    $imageTags = $_POST['tags'];

    try {

        echo $twig->render('form-edit.twig',
            [
                'type' => 'success',
                'message' => 'The image has been successfully updated.'
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
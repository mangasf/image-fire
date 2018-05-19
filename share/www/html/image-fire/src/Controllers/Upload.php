<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../autoload.php';

use Mangasf\ImageFire\Application\Service\StorageImage;
use Mangasf\ImageFire\Application\Service\UpdateImage;
use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Infrastructure\Repositories\StorageImageMysql;
use Mangasf\ImageFire\Infrastructure\Repositories\UpdateImageMysql;

if ($_POST) {
    $imageId = (int)$_POST['id'];
    $imageName = $_POST['name'];
    $imageContain = $_POST['contain'];
    $imageDescription = $_POST['description'];
    $imageTags = $_POST['tags'];
    var_dump($imageId);
    var_dump($imageName);
    var_dump($imageContain);
    var_dump($imageDescription);
    var_dump($imageTags);
    $image = new Image($imageId, $imageName, $imageContain, $imageDescription, $imageTags);
    $updateRepo = new UpdateImageMysql();
    $updateImage = new UpdateImage($updateRepo);
    $updateImage($image);
    header("Location: ../../index.php");
} else {
    var_dump('NEW');
    $target_dir = "../../upload/";
    $storage_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $_FILES['file']['name'])) {
        $status = 1;
    }

    $image = new Image(0, $_FILES['file']['name'], $storage_dir . $_FILES['file']['name'], '', '');
    $storageRepo = new StorageImageMysql();
    $storageImage = new StorageImage($storageRepo);
    $storageImage($image);
}

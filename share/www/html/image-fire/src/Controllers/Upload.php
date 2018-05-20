<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../autoload.php';

use Mangasf\ImageFire\Application\Service\StorageImage;
use Mangasf\ImageFire\Application\Service\UpdateImage;
use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Infrastructure\Repositories\Elastic\StorageImageElastic;
use Mangasf\ImageFire\Infrastructure\Repositories\Elastic\UpdateImageElastic;
use Mangasf\ImageFire\Infrastructure\Repositories\MySql\StorageImageMysql;
use Mangasf\ImageFire\Infrastructure\Repositories\MySql\UpdateImageMysql;

if ($_POST) {
    $imageId = $_POST['id'];
    $imageName = $_POST['name'];
    $imageContain = $_POST['contain'];
    $imageDescription = $_POST['description'];
    $imageTags = $_POST['tags'];
    $image = new Image($imageId, $imageName, $imageContain, $imageDescription, $imageTags);
    $updateRepoMysql = new UpdateImageMysql();
    $updateRepoElastic = new UpdateImageElastic();
    $updateImageMysql = new UpdateImage($updateRepoMysql);
    $updateImageElastic = new UpdateImage($updateRepoElastic);
    $updateImageMysql($image);
    $updateImageElastic($image);
    header("Location: ../../index.php");
} else {
    $target_dir = "../../upload/";
    $storage_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $_FILES['file']['name'])) {
        $status = 1;
    }

    $uuid = uniqid();
    $image = new Image($uuid, $_FILES['file']['name'], $storage_dir . $_FILES['file']['name'], '', '');
    $storageRepoMysql = new StorageImageMysql();
    $storageRepoElastic = new StorageImageElastic();
    $storageImageMysql = new StorageImage($storageRepoMysql);
    $storageImageElastic = new StorageImage($storageRepoElastic);
    $storageImageMysql($image);
    $storageImageElastic($image);
}

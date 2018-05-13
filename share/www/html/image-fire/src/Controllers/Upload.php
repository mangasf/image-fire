<?php

require '../../autoload.php';

use Mangasf\ImageFire\Application\Service\StorageImage;
use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Infrastructure\Repositories\StorageImageMysql;

$target_dir = "../../upload/";
$storage_dir = "upload/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
    $status = 1;
}

$image = new Image(0, $_FILES['file']['name'], $storage_dir.$_FILES['file']['name']);
$storageRepo = new StorageImageMysql();
$storageImage = new StorageImage($storageRepo);
$storageImage($image);
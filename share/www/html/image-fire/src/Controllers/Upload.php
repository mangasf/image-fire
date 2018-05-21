<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../autoload.php';

use Mangasf\ImageFire\Application\Service\QueuesPublishMessage;
use Mangasf\ImageFire\Application\Service\StorageImage;
use Mangasf\ImageFire\Application\Service\UpdateImage;
use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Infrastructure\Queues\RabbitMQOrchestrator;
use Mangasf\ImageFire\Infrastructure\Repositories\Elastic\StorageImageElastic;
use Mangasf\ImageFire\Infrastructure\Repositories\Elastic\UpdateImageElastic;
use Mangasf\ImageFire\Infrastructure\Repositories\MySql\StorageImageMysql;
use Mangasf\ImageFire\Infrastructure\Repositories\MySql\UpdateImageMysql;
use Mangasf\ImageFire\Infrastructure\Repositories\Redis\StorageImageRedis;
use Mangasf\ImageFire\Infrastructure\Repositories\Redis\UpdateImageRedis;

if ($_POST) {
    $imageId = $_POST['id'];
    $imageName = $_POST['name'];
    $imageContain = $_POST['contain'];
    $imageDescription = $_POST['description'];
    $imageTags = $_POST['tags'];

    $image = new Image($imageId, $imageName, $imageContain, $imageDescription, $imageTags);

    $updateRepoMysql = new UpdateImageMysql();
    $updateRepoElastic = new UpdateImageElastic();
    $updateRepoRedis = new UpdateImageRedis();

    $updateImageMysql = new UpdateImage($updateRepoMysql);
    $updateImageElastic = new UpdateImage($updateRepoElastic);
    $updateImageRedis = new UpdateImage($updateRepoRedis);

    $updateImageMysql($image);
    $updateImageElastic($image);
    $updateImageRedis($image);

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
    $storageRepoRedis = new StorageImageRedis();

    $storageImageMysql = new StorageImage($storageRepoMysql);
    $storageImageElastic = new StorageImage($storageRepoElastic);
    $storageImageRedis = new StorageImage($storageRepoRedis);

    $storageImageMysql($image);
    $storageImageElastic($image);
    $storageImageRedis($image);

    /*$queuesOrchestrator = new RabbitMQOrchestrator();
    $queuesPublishMessage = new QueuesPublishMessage($queuesOrchestrator);

    $transformations = [
        ['transformation' => 'resizeToHeight500', 'tag' => 'resizeToHeight500'],
        ['transformation' => 'resizeToHeight200', 'tag' => 'resizeToHeight200'],
        ['transformation' => 'resizeToWidth500', 'tag' => 'resizeToWidth500'],
        ['transformation' => 'resizeToWidth200', 'tag' => 'resizeToWidth200'],
        ['transformation' => 'scaleImage50', 'tag' => 'scaleImage50'],
        ['transformation' => 'addFilter', 'tag' => 'blur'],
        ['transformation' => 'cropImage200_200', 'tag' => 'cropped200_200']
    ];

    foreach ($transformations as $transformation) {
        $targetTransformedDir = $transformed_dir . $transformation['tag'] . '_' . str_replace(' ', '-', $_FILES['file']['name']);
        $data = [
            'current_directory' => $targetDir,
            'transformation' => $transformation['transformation'],
            'destination_directory' => $targetTransformedDir,
            'tag' => $transformation['tag']
        ];

        $queuesPublishMessage('transformations', $data);
    }*/
}

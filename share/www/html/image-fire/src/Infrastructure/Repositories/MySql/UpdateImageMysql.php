<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\MySql;

use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\StorageImageRepository;
use Mangasf\ImageFire\Domain\Repositories\UpdateImageRepository;
use PDO;
use PDOException;

final class UpdateImageMysql implements UpdateImageRepository
{
    private $connection;

    public function __construct()
    {
        $host = 'localhost';
        $dbName = 'image_fire';
        $userName = 'root';
        $password = 'root';

        try {
            $this->connection = new PDO("mysql:host={$host};dbname={$dbName}", $userName, $password);
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function updateImage(Image $image)
    {
        $id = $image->getId();
        $description = $image->getDescription();
        $tags = $image->getTags();

        $query = 'UPDATE Images SET description = ?, tags = ? WHERE id = ?;';
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $description);
        $stmt->bindParam(2, $tags);
        $stmt->bindParam(3, $id);
        $stmt->execute();
    }
}
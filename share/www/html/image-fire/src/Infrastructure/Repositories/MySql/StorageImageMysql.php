<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\MySql;

use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\StorageImageRepository;
use PDO;
use PDOException;

final class StorageImageMysql implements StorageImageRepository
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

    public function storageImage(Image $image)
    {
        $id = $image->getId();
        $name = $image->getName();
        $contain = $image->getContain();

        $query = "INSERT INTO Images SET id = ?, name = ?, contain = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $contain);
        $stmt->execute();
    }
}
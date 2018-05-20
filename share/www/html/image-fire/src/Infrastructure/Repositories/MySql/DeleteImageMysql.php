<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories\MySql;

use Mangasf\ImageFire\Domain\Repositories\DeleteImageRepository;
use PDO;
use PDOException;

final class DeleteImageMysql implements DeleteImageRepository
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

    public function deleteImage(string $imageId)
    {
        $query = "DELETE FROM Images WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $imageId);
        $stmt->execute();
    }
}
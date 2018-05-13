<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Infrastructure\Repositories;

use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\ListImagesRepository;
use PDO;
use PDOException;

final class ListImagesMysql implements ListImagesRepository
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

    public function getAllImages(): array
    {
        $query = 'SELECT name, contain FROM Images';
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $images = [];

        foreach ($rows as $row) {
            $image = new Image($row['name'], $row['contain']);
            array_push($images, $image);
        }

        return $images;
    }
}
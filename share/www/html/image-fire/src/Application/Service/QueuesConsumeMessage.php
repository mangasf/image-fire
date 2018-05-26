<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Application\Service;

use Mangasf\ImageFire\Domain\ImageTools\ImageProcessor;
use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\StorageImageRepository;
use Mangasf\ImageFire\Domain\Entity\Message;

final class QueuesConsumeMessage
{
    private $imageProcessor;
    private $repoInserterMysql;
    private $repoInserterRedis;
    private $repoInserterElastic;

    public function __construct(
        ImageProcessor $imageProcessor,
        StorageImageRepository $repoInserterMysql,
        StorageImageRepository $repoInserterRedis,
        StorageImageRepository $repoInserterElastic
    )
    {
        $this->imageProcessor = $imageProcessor;
        $this->repoInserterMysql = $repoInserterMysql;
        $this->repoInserterRedis = $repoInserterRedis;
        $this->repoInserterElastic = $repoInserterElastic;
    }

    public function __invoke(Message $message)
    {
        $process_val = [
            'resizeToHeight250' => 250,
            'resizeToWidth250' => 250,
            'resizeToHeight150' => 150,
            'resizeToWidth150' => 150,
            'resizeToHeight75' => 75,
            'resizeToWidth75' => 75,
        ];

        $this->imageProcessor->resizeToHeight(
            $message->srcImage(), $process_val[$message->action()],
            $message->distImage()
        );

        $uuid = uniqid();
        $imageProcessed = new Image(
            $uuid,
            explode('/', $message->distImage())[1],
            $message->distImage(),
            '',
            $message->action()
        );

        $this->repoInserterMysql->storageImage($imageProcessed);
        $this->repoInserterRedis->storageImage($imageProcessed);
        $this->repoInserterElastic->storageImage($imageProcessed);
    }
}
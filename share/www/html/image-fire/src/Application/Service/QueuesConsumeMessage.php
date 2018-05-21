<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Application\Service;

use Mangasf\ImageFire\Domain\ImageTools\ImageProcessor;
use Mangasf\ImageFire\Domain\Models\Image;
use Mangasf\ImageFire\Domain\Repositories\StorageImageRepository;
use Mangasf\ImageFire\Domain\VO\Message;

final class QueuesConsumeMessage
{
    private $imageProcessor;
    private $repoImageInserter;

    public function __construct(ImageProcessor $imageProcessor, StorageImageRepository $repoImageInserter)
    {
        $this->imageProcessor = $imageProcessor;
        $this->repoImageInserter = $repoImageInserter;
    }

    public function __invoke(Message $message)
    {
        switch ($message->getProcess()) {

            case 'resizeToHeight250':

                $this->imageProcessor->resizeToHeight(
                    $message->getImageToProcess(), 250,
                    $message->getImageProcessedDestination()
                );

                $uuid = uniqid();
                $imageProcessed = new Image(
                    $uuid,
                    'name',
                    $message->getImageProcessedDestination(),
                    '',
                    'resizeToHeight250'
                );

                $this->repoImageInserter->storageImage($imageProcessed);
                break;

            case 'resizeToWidth250':

                $this->imageProcessor->resizeToWidth(
                    $message->getImageToProcess(), 250,
                    $message->getImageProcessedDestination()
                );

                $uuid = uniqid();
                $imageProcessed = new Image(
                    $uuid,
                    'name',
                    $message->getImageProcessedDestination(),
                    '',
                    'resizeToHeight250'
                );

                $this->repoImageInserter->storageImage($imageProcessed);

                break;

            case 'resizeToHeight150':

                $this->imageProcessor->resizeToHeight(
                    $message->getImageToProcess(), 150,
                    $message->getImageProcessedDestination()
                );

                $uuid = uniqid();
                $imageProcessed = new Image(
                    $uuid,
                    'name',
                    $message->getImageProcessedDestination(),
                    '',
                    'resizeToHeight150'
                );

                $this->repoImageInserter->storageImage($imageProcessed);
                break;

            case 'resizeToWidth150':

                $this->imageProcessor->resizeToWidth(
                    $message->getImageToProcess(), 150,
                    $message->getImageProcessedDestination()
                );

                $uuid = uniqid();
                $imageProcessed = new Image(
                    $uuid,
                    'name',
                    $message->getImageProcessedDestination(),
                    '',
                    'resizeToHeight150'
                );

                $this->repoImageInserter->storageImage($imageProcessed);

                break;

            case 'resizeToHeight75':

                $this->imageProcessor->resizeToHeight(
                    $message->getImageToProcess(), 75,
                    $message->getImageProcessedDestination()
                );

                $uuid = uniqid();
                $imageProcessed = new Image(
                    $uuid,
                    'name',
                    $message->getImageProcessedDestination(),
                    '',
                    'resizeToHeight75'
                );

                $this->repoImageInserter->storageImage($imageProcessed);
                break;

            case 'resizeToWidth75':

                $this->imageProcessor->resizeToWidth(
                    $message->getImageToProcess(), 75,
                    $message->getImageProcessedDestination()
                );

                $uuid = uniqid();
                $imageProcessed = new Image(
                    $uuid,
                    'name',
                    $message->getImageProcessedDestination(),
                    '',
                    'resizeToHeight75'
                );

                $this->repoImageInserter->storageImage($imageProcessed);
        }
    }
}
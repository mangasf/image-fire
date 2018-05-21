<?php

declare(strict_types=1);

namespace Mangasf\ImageFire\Domain\VO;

final class Message
{
    protected $process;
    protected $imageToProcess;
    protected $imageProcessedDestination;

    public function __construct(string $proccess, string $imageToProcess, string $imageProcessedDestination)
    {
        $this->process = $proccess;
        $this->imageToProcess = $imageToProcess;
        $this->imageProcessedDestination = $imageProcessedDestination;
    }

    public function getProcess(): string
    {
        return $this->process;
    }

    public function getImageToProcess(): string
    {
        return $this->imageToProcess;
    }

    public function getImageProcessedDestination(): string
    {
        return $this->imageProcessedDestination;
    }
}
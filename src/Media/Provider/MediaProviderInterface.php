<?php

namespace Media\Provider;

use Media\Entity\MediaInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface MediaProviderInterface
{

    /**
     * 
     * @param UploadedFile $file
     * @param string $directory
     * 
     * @return string
     */
    public function generateName(UploadedFile $file, $directory);

    /**
     * 
     * @param MediaInterface $media
     * @param string $class
     * @param array $options
     * 
     * @return MediaInterface
     */
    public function save(MediaInterface $media, $class, $options);
}

<?php

namespace Media\Provider;

use Doctrine\ORM\EntityManager;
use Media\Entity\MediaInterface;
use Media\Provider\MediaProviderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaProvider implements MediaProviderInterface
{

    /**
     *
     * @var EntityManager
     */
    private $em;

    /**
     *
     * @var string
     */
    private $path;

    /**
     * 
     * @param EntityManager $em
     * @param string $path
     */
    public function __construct(EntityManager $em, $path)
    {
        $this->em = $em;
        $this->path = $path;
    }

    /**
     * 
     * @param UploadedFile $file
     * @param string $directory
     * 
     * @return string
     */
    public function generateName(UploadedFile $file, $directory)
    {
        $extension = $file->guessClientExtension();
        do {
            $filename = md5(uniqid()) . '.' . $extension;
            if (file_exists($directory . DIRECTORY_SEPARATOR . $filename)) {
                $filename = null;
            }
        } while (is_null($filename));

        return $filename;
    }

    public function save(MediaInterface $media, $class, $options)
    {

        if (!$media->getFileContent() instanceof UploadedFile) {
            return $media;
        }

        $directory = $this->path . DIRECTORY_SEPARATOR . $options['context'];
        if (!is_dir($directory) || !is_writeable($directory)) {
            mkdir($directory, '0755', true);
        }

        if ($options['new_on_update']) {
            $entity = new $class;
        } else {
            $entity = clone $media;
        }

        $filename = $this->generateName($media->getFileContent(), $directory);

        $media->getFileContent()->move($directory, $filename);

        $entity->setFileName($filename);
        $entity->setContext($options['context']);
        $entity->setFileType($media->getFileContent()->getClientMimeType());
        $entity->setFileSize($media->getFileContent()->getClientSize());
        $entity->setMetadata([
            'filename' => $media->getFileContent()->getClientOriginalName(),
            'filesize' => $media->getFileContent()->getClientSize(),
            'filetype' => $media->getFileContent()->getClientMimeType(),
            'extension' => $media->getFileContent()->getClientOriginalExtension()
        ]);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

}

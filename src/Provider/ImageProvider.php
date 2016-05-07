<?php

namespace Media\Provider;

use Media\Entity\Media;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageProvider
{

	/**
     *
     * @var \Silex\Application
     */
    private $app;
	
    /**
     *
     * @var array
     */
    private $options;

    /**
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * 
     * @param \Silex\Application $app
     * @param array $options
     */
    public function __construct(\Silex\Application $app, $options = array())
    {
        $this->app = $app;
        $this->options = $options;
        $this->entityManager = $this->app['orm.em'];
    }

    public function guestName()
    {
        return md5(microtime());
    }

    /**
     * 
     * @param UploadedFile $file
     * 
     * @return array
     */
    public function getMetaData(UploadedFile $file)
    {
        $meta = array();
        $meta['mime_type'] = $file->getMimeType();
        $meta['extension'] = $file->guessClientExtension();
        $meta['file_name'] = $file->getClientOriginalName();
        return $meta;
    }

    /**
     * 
     * @param UploadedFile $file
     * 
     * @return Media
     */
    public function save(UploadedFile $file, Media $media = null)
    {

        if (!$media instanceof Media) {
            $media = new Media();
        }

        $meta = $this->getMetaData($file);
        $name = $this->guestName() . "." . $file->guessClientExtension();
        $directory = WEB . 'uploads' . DIRECTORY_SEPARATOR . (intval($media->getId() / 1000));
        
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $file->move($directory, $name);

        $media->setName($name);
        $media->setMeta($meta);
        $media->setIsActive(true);
        $media->setReference($file->getClientOriginalName());
        
        $this->entityManager->persist($media);
        $this->entityManager->flush();
        
        return $media;
    }
    
    /**
     * 
     * @param Media $media
     * @param boolean $keep
     * 
     * @return Media
     */
    public function remove(Media $media)
    {
        
        $directory = WEB . 'uploads' . DIRECTORY_SEPARATOR . (intval($media->getId() / 1000));
        if (file_exists($directory . DIRECTORY_SEPARATOR . $media->getName())) {
            unlink($directory . DIRECTORY_SEPARATOR . $media->getName());
        }
        
        return $media;
    }

}

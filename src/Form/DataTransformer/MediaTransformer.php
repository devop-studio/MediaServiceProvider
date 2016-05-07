<?php

namespace Media\Form\DataTransformer;

use Media\Entity\Media;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MediaTransformer implements DataTransformerInterface
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
     * @var \Media\Provider\ImageProvider
     */
    private $provider;
    
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
        $this->provider = new \Media\Provider\ImageProvider($app);
        $this->entityManager = $this->app['orm.em'];
    }

    /**
     * 
     * @param Media|null $value
     * 
     * @return integer
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * 
     * @param integer|Media|UploadedFile $value
     * 
     * @return Media
     * 
     * @throws TransformationFailedException
     */
    public function reverseTransform($value = null)
    {
        if (null === $value) {
            return null;
        }
        else if ($value->getBinary()) {
            return $this->provider->save($value->getBinary(), $value);
        }
        else if ($value->getId()) {
            return $value;
        }
        
        $media = $this->entityManager->getRepository('Media\Entity\Media')->find($value->getId());
        
        if ($media instanceof Media) {
            return $media;
        }
        
        throw new TransformationFailedException();
    }

}

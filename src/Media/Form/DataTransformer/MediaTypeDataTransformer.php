<?php

namespace Media\Form\DataTransformer;

use Media\Entity\MediaInterface;
use Media\Provider\MediaProviderInterface;
use Symfony\Component\Form\DataTransformerInterface;

class MediaTypeDataTransformer implements DataTransformerInterface
{

    /**
     *
     * @var string
     */
    private $class;
    
    /**
     *
     * @var array|null
     */
    private $options;
    
    /**
     *
     * @var MediaProviderInterface
     */
    private $provider;

    /**
     * 
     * @param MediaProviderInterface $provider
     * @param string $class
     * @param array|null $options
     */
    public function __construct(MediaProviderInterface $provider, $class, $options)
    {
        $this->class = $class;
        $this->options = $options;
        $this->provider = $provider;
    }

    /**
     * 
     * @param MediaInterface|null $value
     * 
     * @return MediaInterface
     */
    public function reverseTransform($value)
    {

        if (is_null($value)) {
            return null;
        } else if ($value instanceof MediaInterface) {
            return $this->provider->save($value, $this->class, $this->options);
        }
        
        return $value;
    }

    /**
     * 
     * @param MediaInterface|null $value
     * 
     * @return MediaInterface|null
     */
    public function transform($value)
    {
        return $value;
    }

}

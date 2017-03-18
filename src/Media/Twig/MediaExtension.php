<?php

namespace Media\Twig;

use Media\Entity\MediaInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MediaExtension extends \Twig_Extension
{

    /**
     *
     * @var RequestStack
     */
    private $request;
    
    public function __construct(RequestStack $request)
    {
        $this->request = $request;
    }
    
    /**
     * 
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('media', [$this, 'media'])
        ];
    }

    /**
     * 
     * @param MediaInterface $media
     * 
     * @return string
     */
    public function media(MediaInterface $media = null)
    {
        if (empty($media)) {
            return true;
        }
        return sprintf('%s/uploads/%s/%s', $this->request->getCurrentRequest()->getBasePath(), $media->getContext(), $media->getFileName());
    }

}

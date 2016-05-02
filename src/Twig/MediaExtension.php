<?php

namespace Media\Twig;

class MediaExtension extends \Twig_Extension
{
    
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('media', array($this, 'media'))
        );
    }
    
    public function media(\Media\Entity\Media $media)
    {
        $url = "uploads/" . intval($media->getId()/1000) . "/" . $media->getName();
        $base = \App\Application::getInstance()->getSilexApplication()['request']->getBasePath();
        return sprintf("%s/%s", $base, $url);
    }
    
    public function getName()
    {
        return "media_extension";
    }

}


<?php

namespace Media\Twig;

class MediaExtension extends \Twig_Extension
{

    /**
     *
     * @var \Silex\Application
     */
    private $app;

    /**
     * 
     * @param \Silex\Application $app
     */
    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
        $this->app->register(new \Silex\Provider\FormServiceProvider());
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('media', array($this, 'media'))
        );
    }

    public function media(\Media\Entity\Media $media)
    {
        $url = "uploads/" . intval($media->getId() / 1000) . "/" . $media->getName();
        $base = $this->app['request']->getBasePath();
        return sprintf("%s/%s", $base, $url);
    }

    public function getName()
    {
        return "media_extension";
    }

}

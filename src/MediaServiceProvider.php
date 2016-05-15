<?php

namespace Media;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Media\Exception\InvalidConfigurationException;

class MediaServiceProvider implements ServiceProviderInterface
{

    public function boot(Application $app)
    {
        
        if (!$app->offsetExists('upload.path')) {
            throw new InvalidConfigurationException;
        }
        
    }

    public function register(Application $app)
    {

        if ($app->offsetExists('form.factory')) {
            $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
                        $types[] = new Form\Type\MediaType($app);
                        return $types;
                    }));
        }

        if ($app->offsetExists('twig')) {
            $app['twig'] = $app->share($app->extend('twig', function(\Twig_Environment $twig) use ($app) {
                        $twig->addExtension(new Twig\MediaExtension($app));
                        return $twig;
                    }));

            $app['twig.path'] = array_merge($app['twig.path'], array(
                __DIR__ . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'views'
            ));

            $app['twig.form.templates'] = array_merge($app['twig.form.templates'], array("media.type.html.twig"));
        }
    }

}

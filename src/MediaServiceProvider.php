<?php

namespace Media;

use Silex\Application;
use Silex\ServiceProviderInterface;

class MediaServiceProvider implements ServiceProviderInterface
{

    public function boot(Application $app)
    {
        
    }

    public function register(Application $app)
    {

        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
                    $types[] = new Form\Type\MediaType($app);
                    return $types;
                }));

        $app['twig'] = $app->share($app->extend('twig', function(\Twig_Environment $twig) use ($app) {
                    $twig->addExtension(new Twig\MediaExtension($app));
                    return $twig;
                }));

        $app['twig.path'] = array_merge_recursive($app['twig.path'], array(
            __DIR__ . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'views'
        ));

        $app['twig.form.templates'] = array_merge_recursive($app['twig.form.templates'], array("media.type.html.twig"));
    }

}

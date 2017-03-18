<?php

namespace Media;

use Pimple\Container;
use Silex\Application;
use Media\Form\Type\MediaType;
use Media\Provider\MediaProvider;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Media\Provider\MediaProviderInterface;
use Media\Form\DataTransformer\MediaTypeDataTransformer;

class MediaServiceProvider implements BootableProviderInterface, ServiceProviderInterface
{

    /**
     * 
     * @param Container $pimple
     * 
     * @throws \RuntimeException
     */
    public function register(Container $pimple)
    {

        if ($pimple->offsetExists('media.type.provider')) {
            if (!$pimple->offsetGet('media.type.provider') instanceof MediaProviderInterface) {
                throw new \RuntimeException('Service media.type.provider must implements \Media\Provider\MediaProviderInterface');
            }
        } else {
            $pimple['media.type.provider'] = function() use ($pimple) {
                return new MediaProvider($pimple['orm.em'], $pimple['media.upload.path']);
            };
        }

        if ($pimple->offsetExists('media.type.data.transformer')) {
            if (!$pimple->offsetGet('media.type.data.transformer') instanceof MediaProviderInterface) {
                throw new \RuntimeException('Service media.type.data.transformer must implements \Media\Provider\MediaProviderInterface');
            }
        } else {
            $pimple['media.type.data.transformer'] = function() {
                return MediaTypeDataTransformer::class;
            };
        }

        $pimple->extend('twig', function($twig) use ($pimple) {
            $twig->addExtension(new \Media\Twig\MediaExtension($pimple['request_stack']));
            return $twig;
        });

        $resourceDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'views';
        if (is_array($pimple['twig.path'])) {
            $pimple['twig.path'] = array_merge($pimple['twig.path'], [$resourceDirectory]);
        } else {
            $pimple['twig.path'] = [$pimple['twig.path'], $resourceDirectory];
        }

        if (is_array($pimple['twig.form.templates'])) {
            $pimple['twig.form.templates'] = array_merge($pimple['twig.form.templates'], ['Form/media.widget.twig']);
        } else {
            $pimple['twig.form.templates'] = [$pimple['twig.form.templates'], 'Form/media.widget.twig'];
        }


        $pimple->extend('form.types', function ($types) use ($pimple) {
            $types[MediaType::class] = new MediaType($pimple['media.type.data.transformer'], $pimple['media.type.provider'], $pimple['media.entity']);
            return $types;
        });
    }

    /**
     * 
     * @param Application $app
     * 
     * @throws \RuntimeException
     */
    public function boot(Application $app)
    {
        if (!$app->offsetExists('media.entity')) {
            throw new \RuntimeException('Parameter media.entity must be exists and implemented \Media\Entity\MediaInterface.');
        }

        if (!$app->offsetExists('media.upload.path')) {
            throw new \RuntimeException('Parameter media.upload.path must exists and be a writable folder.');
        }
    }

}

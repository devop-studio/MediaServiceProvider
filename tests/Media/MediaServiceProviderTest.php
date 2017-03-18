<?php

namespace Media\Tests;

class MediaServiceProviderTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var \Silex\Application
     */
    private $app;

    public function setUp()
    {
        $this->app = new \Silex\Application(array('debug' => true));
        $this->app->register(new \Silex\Provider\TwigServiceProvider(), []);
        $this->app->register(new \Silex\Provider\FormServiceProvider(), []);
    }

    public function testRegisterMediaServiceProviderWithInvalidConfiguration()
    {
        try {
            $this->app->register(new \Media\MediaServiceProvider());
        } catch (\RuntimeException $ex) {
            $this->fail($ex->getMessage());
        }
    }

    public function testRegisterMediaServiceProvider()
    {
        $this->app->register(new \Media\MediaServiceProvider(), [
            'media.entity' => \Media\Tests\Entity\Media::class,
            'media.upload.path' => __DIR__ . DIRECTORY_SEPARATOR . '..']
        );
        $this->assertTrue(true);
    }

}

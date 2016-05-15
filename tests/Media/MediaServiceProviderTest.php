<?php

namespace Media\Tests;

use Symfony\Component\Form\Extension\Core\Type\FormType;

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
    }

    public function testRegisterMediaServiceProviderWithInvalidConfiguration()
    {
        try {
            $this->app->register(new \Media\MediaServiceProvider());
        } catch (\Media\Exception\InvalidConfigurationException $ex) {
            $this->fail('upload.path missing from your application');
        }
    }

    public function testRegisterMediaServiceProvider()
    {
        $this->app->register(new \Media\MediaServiceProvider(), ['upload.path' => __DIR__ . DIRECTORY_SEPARATOR . '..']);
        $this->assertTrue(true);
    }

}

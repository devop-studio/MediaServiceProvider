| Sensiolab Insight | Travis-CI | Scrutinizer |
| --- | --- | --- |
| [![SensioLabsInsight](https://insight.sensiolabs.com/projects/b2f1757d-acf4-4380-8e2f-d4b6567fbfde/mini.png)](https://insight.sensiolabs.com/projects/b2f1757d-acf4-4380-8e2f-d4b6567fbfde) | [![Build Status](https://travis-ci.org/development-x/MediaServiceProvider.svg?branch=master)](https://travis-ci.org/development-x/MediaServiceProvider) | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/badges/build.png?b=master)](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/build-status/master) |

| VersionEye | Packagist |
| --- | --- |
| [![Dependency Status](https://www.versioneye.com/user/projects/5810b8d58a555e001637e67e/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/5810b8d58a555e001637e67e) | [![Packagist](https://img.shields.io/packagist/dt/development-x/MediaServiceProvider.svg)](https://github.com/development-x/MediaServiceProvider) [![Packagist](https://img.shields.io/packagist/l/development-x/MediaServiceProvider.svg)](https://github.com/development-x/MediaServiceProvider) [![Packagist Pre Release](https://img.shields.io/packagist/vpre/development-x/MediaServiceProvider.svg)](https://github.com/development-x/MediaServiceProvider) [![Packagist Pre Release](https://img.shields.io/hhvm/development-x/MediaServiceProvider.svg)](https://github.com/development-x/MediaServiceProvider) |

Media Service Provider
=============================

Adding media service provider (inspired by [SonataMediaBundle](https://github.com/sonata-project/SonataMediaBundle))


Features
--------

 * Adding DoctrineORM Entity for hold db records.
 * Customized templates


Requirements
------------

 * PHP 5.3+
 * Pimple ~2.1
 * Doctrine ~2.3

Installation
------------
Install with [Composer](http://packagist.org), run:

```sh
composer require development-x/media-service-provider
```

### Register first
```php
<?php

use Silex\Application;

$app->register(new \Media\MediaServiceProvider())

```

### Create entity Media, and extend Base Entity 

```php
<?php

namespace App\Entity;

use Media\Entity\Media AS BaseMedia;

/**
 * 
 * @Entity
 * @HasLifecycleCallbacks
 * @Table(name="media_attachments")
 */
class Media extends BaseMedia
{

    /**
     * @var integer
     *
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

```

# ToDo
- [ ] Add more functionality
- [ ] Add more unit tests

# Contributing
However, if you are interested and want to send a bug fix, new functionality or better realization, just send a pull request :)
travis

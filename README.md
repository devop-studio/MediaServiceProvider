| SensioLabs Insight | Travis CI | Scrutinizer CI|
| ------------------------|-------------|-----------------|
|[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f6e15c47-013b-4c08-a301-683859b94b58/mini.png)](https://insight.sensiolabs.com/projects/f6e15c47-013b-4c08-a301-683859b94b58)|[![Build Status](https://travis-ci.org/development-x/PaginationServiceProvider.svg?branch=master)](https://travis-ci.org/development-x/PaginationServiceProvider)|[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/badges/build.png?b=master)](https://scrutinizer-ci.com/g/development-x/MediaServiceProvider/build-status/master)

[![Dependency Status](https://www.versioneye.com/user/projects/5738e700a0ca35004cf78361/badge.svg?style=flat)](https://www.versioneye.com/user/projects/5738e700a0ca35004cf78361) [![Latest Stable Version](https://poser.pugx.org/development-x/media-service-provider/v/stable)](https://packagist.org/packages/development-x/media-service-provider) [![Total Downloads](https://poser.pugx.org/development-x/media-service-provider/downloads)](https://packagist.org/packages/development-x/media-service-provider) [![Latest Unstable Version](https://poser.pugx.org/development-x/media-service-provider/v/unstable)](https://packagist.org/packages/development-x/media-service-provider) [![License](https://poser.pugx.org/development-x/media-service-provider/license)](https://packagist.org/packages/development-x/media-service-provider)

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
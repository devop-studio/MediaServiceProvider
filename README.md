Media Service Provider
=============================

Adding media service provider (inspired by [SonataMediaBundle](https://github.com/sonata-project/SonataMediaBundle)


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

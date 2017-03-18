<?php

namespace Media\Tests\Entity;

/**
 * 
 * @Entity
 * @Table(name="attachments")
 */
class Media extends \Media\Entity\Media implements \Media\Entity\MediaInterface
{

    /**
     * 
     * integer
     * 
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue 
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

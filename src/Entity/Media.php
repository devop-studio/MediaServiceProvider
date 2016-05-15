<?php

namespace Media\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * 
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="media_attachments")
 */
class Media
{
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    protected $name;
    
    /**
     *
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    protected $binary;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    protected $reference;
    
    /**
     *
     * @var array
     * 
     * @ORM\Column(type="array")
     */
    protected $meta;
    
    /**
     *
     * @var boolean
     * 
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    protected $active = true;
    
    /**
     *
     * @var DateTime
     * 
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;
    
    /**
     *
     * @var DateTime
     * 
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName() ? : "";
    }
    
    /**
     * 
     * @return \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function getBinary()
    {
        return $this->binary;
    }
    
    /**
     * 
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $binary
     * 
     * @return \Media\Entity\Media
     */
    public function setBinary($binary)
    {
        $this->binary = $binary;
        
        return $this;
    }
    
    /**
     * 
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
    
    /**
     * 
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Media
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Media
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set meta
     *
     * @param array $meta
     *
     * @return Media
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Media
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Media
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Media
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

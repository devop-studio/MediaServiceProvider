<?php

namespace Media\Entity;

/**
 * 
 * @Entity
 * @HasLifecycleCallbacks
 * @Table(name="media_attachments")
 */
class Media
{
    
    /**
     *
     * @var string
     * 
     * @Column(type="string")
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
     * @Column(type="string")
     */
    protected $reference;
    
    /**
     *
     * @var array
     * 
     * @Column(type="array")
     */
    protected $meta;
    
    /**
     *
     * @var boolean
     * 
     * @Column(name="is_active", type="boolean", nullable=true)
     */
    protected $isActive = true;
    
    /**
     *
     * @var DateTime
     * 
     * @Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;
    
    /**
     *
     * @var DateTime
     * 
     * @Column(name="created_at", type="datetime", nullable=true)
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
     * @PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
    
    /**
     * 
     * @PrePersist
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Media
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
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

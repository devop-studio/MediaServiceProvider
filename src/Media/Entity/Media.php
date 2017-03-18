<?php

namespace Media\Entity;

use Doctrine\ORM\Mapping as ORM;

class Media
{

    /**
     *
     * @var resource
     */
    protected $fileContent;

    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    protected $context;
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string", name="file_name")
     */
    protected $fileName;

    /**
     *
     * @var string
     * 
     * @ORM\Column(type="string", name="file_type")
     */
    protected $fileType;

    /**
     *
     * @var int
     * 
     * @ORM\Column(type="integer", name="file_size")
     */
    protected $fileSize;

    /**
     *
     * @var array
     * 
     * @ORM\Column(type="array", nullable=true)
     */
    protected $metadata;
    
    /**
     * 
     * @return resource
     */
    public function getFileContent()
    {
        return $this->fileContent;
    }

    /**
     * 
     * @param resource $fileContent
     * 
     * @return $this
     */
    public function setFileContent($fileContent)
    {
        $this->fileContent = $fileContent;

        return $this;
    }

    /**
     * Set context
     *
     * @param string $context
     *
     * @return Media
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return Media
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set fileType
     *
     * @param string $fileType
     *
     * @return Media
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * Get fileType
     *
     * @return string
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * Set fileSize
     *
     * @param integer $fileSize
     *
     * @return Media
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get fileSize
     *
     * @return integer
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set metadata
     *
     * @param array $metadata
     *
     * @return Media
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Get metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

}

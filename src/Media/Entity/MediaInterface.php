<?php

namespace Media\Entity;

interface MediaInterface
{

    /**
     * 
     * @return int
     */
    public function getId();

    /**
     * Set context
     *
     * @param string $context
     *
     * @return Media
     */
    public function setContext($context);
    
    /**
     * 
     * Get context
     * 
     * @return string
     */
    public function getContext();
    
    /**
     * 
     * @return \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function getFileContent();

    /**
     * 
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $fileContent
     * 
     * @return $this
     */
    public function setFileContent($fileContent);

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return Media
     */
    public function setFileName($fileName);

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName();

    /**
     * Set fileType
     *
     * @param string $fileType
     *
     * @return Media
     */
    public function setFileType($fileType);

    /**
     * Get fileType
     *
     * @return string
     */
    public function getFileType();

    /**
     * Set fileSize
     *
     * @param integer $fileSize
     *
     * @return Media
     */
    public function setFileSize($fileSize);

    /**
     * Get fileSize
     *
     * @return integer
     */
    public function getFileSize();

    /**
     * Set metadata
     *
     * @param array $metadata
     *
     * @return Media
     */
    public function setMetadata($metadata);

    /**
     * Get metadata
     *
     * @return array
     */
    public function getMetadata();
}

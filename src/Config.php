<?php

namespace Belyakov\Library;

use Belyakov\Library\Contracts\ReaderConfigContract;
use Symfony\Component\Yaml\Yaml;

class Config implements ReaderConfigContract
{
    const MIME_KEY = 'mimeType';
    const SIZE_KEY = 'fileSize';

    /**
     * Config data
     *
     * @var array
     */
    private $config = [];

    public function __construct($path)
    {
        $this->config = Yaml::parseFile($path);
    }

    /**
     * Get available mime type
     *
     * @return string|null
     */
    public function getMimeTypes()
    {
        return ($this->config[self::MIME_KEY] ?? null);
    }

    /**
     * Get max available file size
     *
     * @return string|null
     */
    public function getFileSize()
    {
        return ($this->config[self::SIZE_KEY] ?? null);
    }
}

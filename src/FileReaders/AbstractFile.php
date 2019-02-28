<?php

namespace Belyakov\Library\FileReaders;

use Belyakov\Library\Contracts\FileReaderContract;

abstract class AbstractFile implements FileReaderContract
{
    /**
     * Absolute path to file
     *
     * @var null
     */
    protected $path = null;

    /**
     * Open file handler
     *
     * @var null
     */
    protected $handle = null;

    /**
     * Local constructor.
     *
     * @param string $path Absolute path to file
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Get file path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Read file by strings
     *
     * @return \Generator
     */
    public function read()
    {
        $handle = $this->open();

        while(!feof($handle)) {
            yield fgets($handle);
        }

        fclose($handle);
    }

    /**
     * Open file
     *
     * @return resource
     */
    abstract public function open();
}

<?php

namespace Belyakov\Library;

use Belyakov\Library\Contracts\FileReaderContract;
use Belyakov\Library\Contracts\ModuleContract;
use Belyakov\Library\Contracts\ReaderConfigContract;
use Belyakov\Library\Exception\InvalidFile;

class FileReader
{
    /**
     * @var FileReaderContract
     */
    private $file = null;

    /**
     * @var ModuleContract
     */
    private $module = null;

    /**
     * FileReader constructor.
     *
     * @param FileReaderContract $file File
     * @param ModuleContract $module Module
     * @param ReaderConfigContract $config Config
     * @throws InvalidFile
     */
    public function __construct(FileReaderContract $file, ModuleContract $module, ReaderConfigContract $config)
    {
        // Checks from config
        if (($fileSize = $config->getFileSize()) !== null) {
            if ($file->getSize() > $fileSize) {
                throw new InvalidFile('File size more then available ' . $fileSize . ' bytes');
            }
        }

        if (($mimeTypes = $config->getMimeTypes()) !== null) {
            $mimeType = $file->getMimeType();
            if ($mimeType && !in_array($mimeType, $mimeTypes)) {
                throw new InvalidFile('Unavailable file mime type ' . $mimeType);
            }
        }
        // All is ok
        $this->file = $file;
        $this->module = $module;
    }

    /**
     * Get result
     *
     * @return mixed
     */
    public function result()
    {
        return $this->module->process($this->file);
    }
}

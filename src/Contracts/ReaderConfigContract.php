<?php

namespace Belyakov\Library\Contracts;

interface ReaderConfigContract
{
    /**
     * Get mime types
     *
     * @return array
     */
    public function getMimeTypes();

    /**
     * Get file size in bytes
     *
     * @return int
     */
    public function getFileSize();
}

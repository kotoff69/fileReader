<?php

namespace Belyakov\Library\FileReaders;

use Belyakov\Library\Contracts\FileInfoContract;
use Belyakov\Library\Contracts\FileReaderContract;

class Local extends AbstractFile implements FileReaderContract, FileInfoContract
{
    /**
     * Open file
     *
     * @return resource
     */
    public function open()
    {
        $this->handle = fopen($this->path, "r");
        return $this->handle;
    }

    /**
     * Get file mime-type
     *
     * @return string
     */
    public function getMimeType(): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $this->path);
        finfo_close($finfo);

        return $mime;
    }

    /**
     * Get file size
     * @return int
     */
    public function getSize(): int
    {
        return filesize($this->path);
    }
}

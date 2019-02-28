<?php

namespace Belyakov\Library\Contracts;

interface FileReaderContract
{
    /**
     * Open file
     *
     * @return resource handler
     */
    public function open();

    /**
     * Get file path
     *
     * @return string
     */
    public function getPath(): string;
}

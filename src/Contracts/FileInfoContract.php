<?php

namespace Belyakov\Library\Contracts;

interface FileInfoContract
{
    /**
     * Get file mime-type
     *
     * @return string
     */
    public function getMimeType(): string;

    /**
     * Get file size
     * @return int
     */
    public function getSize(): int;
}

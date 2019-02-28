<?php

namespace Belyakov\Library\Contracts;

interface ModuleContract
{
    /**
     * Process module logic
     *
     * @param FileReaderContract $file File
     */
    public function process(FileReaderContract $file);
}

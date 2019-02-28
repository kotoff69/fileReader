<?php

namespace Belyakov\Library\Factories;

use Belyakov\Library\Config;
use Belyakov\Library\FileReader;
use Belyakov\Library\FileReaders\Local;
use Belyakov\Library\Modules\SearchString;

class SearchLocalFileFactory
{
    /**
     * @param $path
     * @param $searchString
     * @return FileReader
     * @throws \Belyakov\Library\Exception\InvalidFile
     * @throws \Belyakov\Library\Exception\InvalidParameter
     */
    public static function make($path, $searchString)
    {
        $file = new Local($path);
        $module = new SearchString($searchString);
        $config = new Config('./config.yaml');

        return new FileReader($file, $module, $config);
    }
}

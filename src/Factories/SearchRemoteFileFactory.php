<?php

namespace Belyakov\Library\Factories;

use Belyakov\Library\Config;
use Belyakov\Library\FileReader;
use Belyakov\Library\FileReaders\Remote;
use Belyakov\Library\Modules\SearchString;

class SearchRemoteFileFactory
{
    /**
     * @param $path
     * @param $searchString
     * @param $username
     * @param $password
     * @param $host
     * @param null $port
     * @return FileReader
     * @throws \Belyakov\Library\Exception\InvalidFile
     * @throws \Belyakov\Library\Exception\InvalidParameter
     */
    public static function make($path, $searchString, $username, $password, $host, $port = null)
    {
        $file = new Remote($path, $username, $password, $host, $port);
        $module = new SearchString($searchString);
        $config = new Config('./config.yaml');

        return new FileReader($file, $module, $config);
    }
}

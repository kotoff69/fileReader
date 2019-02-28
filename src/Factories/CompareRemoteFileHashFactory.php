<?php

namespace Belyakov\Library\Factories;

use Belyakov\Library\Config;
use Belyakov\Library\FileReader;
use Belyakov\Library\FileReaders\Remote;
use Belyakov\Library\Modules\CompareHash;

class CompareRemoteFileHashFactory
{
    /**
     * @param $path
     * @param $algorithm
     * @param $hash
     * @param $username
     * @param $password
     * @param $host
     * @param $port
     * @return FileReader
     * @throws \Belyakov\Library\Exception\InvalidFile
     * @throws \Belyakov\Library\Exception\InvalidParameter
     */
    public static function make($path, $algorithm, $hash, $username, $password, $host, $port)
    {
        $file = new Remote($path, $username, $password, $host, $port);
        $module = new CompareHash($algorithm, $hash);
        $config = new Config('./config.yaml');

        return new FileReader($file, $module, $config);
    }
}

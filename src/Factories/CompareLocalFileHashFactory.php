<?php

namespace Belyakov\Library\Factories;

use Belyakov\Library\Config;
use Belyakov\Library\FileReader;
use Belyakov\Library\FileReaders\Local;
use Belyakov\Library\Modules\CompareHash;

class CompareLocalFileHashFactory
{
    /**
     * @param $path
     * @param $algorithm
     * @param $hash
     * @return FileReader
     * @throws \Belyakov\Library\Exception\InvalidParameter
     * @throws \Belyakov\Library\Exception\InvalidFile
     */
    public static function make($path, $algorithm, $hash)
    {
        $file = new Local($path);
        $module = new CompareHash($algorithm, $hash);
        $config = new Config('./config.yaml');

        return new FileReader($file, $module, $config);
    }
}

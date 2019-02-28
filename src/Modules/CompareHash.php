<?php

namespace Belyakov\Library\Modules;

use Belyakov\Library\Contracts\FileReaderContract;
use Belyakov\Library\Contracts\ModuleContract;
use Belyakov\Library\Exception\InvalidParameter;

class CompareHash implements ModuleContract
{
    /**
     * Hash algorithm
     *
     * @var string
     */
    private $algorithm;

    /**
     * Hash to check
     *
     * @var string
     */
    private $hash;

    /**
     * CompareHash constructor.
     * @param string $algorithm Hash algorithm
     * @param string $hash Hash to check
     * @throws InvalidParameter
     */
    public function __construct($algorithm, $hash)
    {
        if (!in_array($algorithm, hash_algos())) {
            throw new InvalidParameter('Unknown hash algorithm');
        }
        $this->algorithm = $algorithm;
        $this->hash = $hash;
    }

    /**
     * Process module logic
     *
     * @param FileReaderContract $file File
     * @return bool
     */
    public function process(FileReaderContract $file)
    {
        $iterator = $file->read();
        $context = hash_init($this->algorithm);

        foreach ($iterator as $string) {
            hash_update($context, $string);
        }

        $resultHash = hash_final($context);

        return ($resultHash == $this->hash);
    }
}

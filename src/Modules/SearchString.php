<?php

namespace Belyakov\Library\Modules;


use Belyakov\Library\Contracts\FileReaderContract;
use Belyakov\Library\Contracts\ModuleContract;
use Belyakov\Library\Exception\InvalidParameter;

class SearchString implements ModuleContract
{
    /**
     * Search string
     *
     * @var string|null
     */
    private $searchString = null;

    /**
     * Line number in text block
     * @var int
     */
    private $currentLineNumber = 0;

    /**
     * SearchString constructor.
     * @param $searchString
     * @throws InvalidParameter
     */
    public function __construct($searchString)
    {
        if (!mb_strlen($searchString)) {
            throw new InvalidParameter('Search string can not be empty');
        }
        $this->searchString = $searchString;
    }

    /**
     * Process module logic
     *
     * @param FileReaderContract $file File
     * @return array|null
     */
    public function process(FileReaderContract $file)
    {
        $iterator = $file->read();
        // Determine lines count in substring
        $linesCount = mb_substr_count($this->searchString, PHP_EOL);
        if (!$linesCount) {
            $linesCount = 1; // Minimum for search
        } else {
            // Found one PHP_EOL => 2 lines
            $linesCount++;
        }

        $buffer = [];

        foreach ($iterator as $lineNumber => $string) {
            // Implode lines at one multilines string
            $buffer[] = $string;

            // Collect minimum required lines for search substring
            if (count($buffer) < $linesCount) {
                continue;
            }

            $fullSubstring = implode('', $buffer);
            // Search position
            $stringPosition = mb_strpos($fullSubstring, $this->searchString);
            if ($stringPosition !== false) {
                return [
                    'line' => ($this->currentLineNumber + 1),
                    'char' => ($stringPosition + 1),
                ];
            } else {
                // Delete first line in buffer
                unset($buffer[$this->currentLineNumber]);
                $this->currentLineNumber++;
            }
        }
        // Did not find
        return null;
    }
}

<?php

use PHPUnit\Framework\TestCase;

class LocalFileReaderTest extends TestCase
{
    /**
     * Test that file can be opened
     *
     * @covers Local::open
     */
    public function testOpenFile()
    {
        $file = new \Belyakov\Library\FileReaders\Local($this->getTestFilePath());
        $this->assertIsResource($file->open());
    }

    /**
     * Test that file paths from constructor param and class method are equals
     *
     * @covers Local::getPath
     */
    public function testEqualsFilePath()
    {
        $file = new \Belyakov\Library\FileReaders\Local($this->getTestFilePath());
        $this->assertEquals($this->getTestFilePath(), $file->getPath());
    }

    /**
     * Test that file size equal
     *
     * @covers Local::getSize
     */
    public function testEqualsFileSize()
    {
        $file = new \Belyakov\Library\FileReaders\Local($this->getTestFilePath());
        echo $this->getSize();

        $this->assertEquals($this->getFileSize(), $file->getSize());
    }

    /**
     * Get full path to test file
     *
     * @return string
     */
    protected function getTestFilePath()
    {
        return dirname(__FILE__) . '/../../dummy-text.txt';
    }

    /**
     * Get fail search string
     *
     * @return int
     */
    protected function getFileSize()
    {
        return 1347;
    }
}

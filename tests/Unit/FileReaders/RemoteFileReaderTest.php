<?php

use PHPUnit\Framework\TestCase;

class RemoteFileReaderTest extends TestCase
{
    protected $file = null;

    public function setUp()
    {
        parent::setUp();
        $params = [$this->getTestFilePath(), null, null, null]; // Last three does not matter
        $this->file = Mockery::mock(\Belyakov\Library\FileReaders\Remote::class, $params)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();
    }

    /**
     * Test that file can be opened
     *
     * @covers Local::open
     */
    public function testOpenFile()
    {
        $handler = fopen($this->getTestFilePath(), 'r');
        $this->file->shouldreceive('openStream')->andReturn($handler);

        $this->assertIsResource($this->file->open());
    }

    /**
     * Test that file paths from constructor param and class method are equals
     *
     * @covers Local::getPath
     */
    public function testEqualsFilePath()
    {
        $this->assertEquals($this->getTestFilePath(), $this->file->getPath());
    }

    /**
     * Test that file size equal
     *
     * @covers Local::getSize
     */
    public function testEqualsFileSize()
    {
        $this->file->shouldreceive('getInfo')->andReturn(['size' => $this->getFileSize()]);
        $this->assertEquals($this->getFileSize(), $this->file->getSize());
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

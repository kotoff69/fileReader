<?php

use PHPUnit\Framework\TestCase;

class SearchStringTest extends TestCase
{
    /**
     * Test that empty search string must throw exception
     *
     * @covers SearchString::__construct
     * @throws \Belyakov\Library\Exception\InvalidParameter
     */
    public function testEmptySearchString()
    {
        $this->expectException(\Belyakov\Library\Exception\InvalidParameter::class);
        $module = new \Belyakov\Library\Modules\SearchString('');
    }

    /**
     * Test success search
     *
     * @covers SearchString::process
     * @throws \Belyakov\Library\Exception\InvalidParameter
     */
    public function testSuccessSearchString()
    {
        $file = new \Belyakov\Library\FileReaders\Local($this->getTestFilePath());
        $module = new \Belyakov\Library\Modules\SearchString($this->getSearchString());
        $this->assertEquals($this->getStringPosition(), $module->process($file));
    }

    /**
     * Test fail search
     *
     * @covers SearchString::process
     * @throws \Belyakov\Library\Exception\InvalidParameter
     */
    public function testFailSearchString()
    {
        $file = new \Belyakov\Library\FileReaders\Local($this->getTestFilePath());
        $module = new \Belyakov\Library\Modules\SearchString($this->getFailSearchString());
        $this->assertNull($module->process($file));
    }

    /**
     * Get fail search string
     *
     * @return string
     */
    protected function getSearchString()
    {
        return 'Try to find me on third line at 432 position.';
    }

    /**
     * Get fail search string
     *
     * @return string
     */
    protected function getFailSearchString()
    {
        return 'You can not find me';
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
     * Get string position
     *
     * @return array
     */
    protected function getStringPosition()
    {
        return ['line' => 3, 'char' => 432];
    }
}

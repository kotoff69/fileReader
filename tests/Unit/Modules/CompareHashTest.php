<?php

use PHPUnit\Framework\TestCase;

class CompareHashTest extends TestCase
{
    /**
     * Test that valid algorithm selected
     *
     * @covers CompareHash::__construct
     */
    public function testValidHashAlgorithm()
    {
        $module = new \Belyakov\Library\Modules\CompareHash($this->getValidAlgotithm(), 'user_hash');
        $this->assertInstanceOf(\Belyakov\Library\Modules\CompareHash::class, $module);
    }

    /**
     * Test that invalid algorithm selected
     *
     * @covers CompareHash::__construct
     */
    public function testInvalidHashAlgorithm()
    {
        $this->expectException(\Belyakov\Library\Exception\InvalidParameter::class);
        $module = new \Belyakov\Library\Modules\CompareHash('invalid_algorithm', 'user_hash');
    }

    /**
     * Test success hash compare
     *
     * @covers SearchString::process
     * @throws \Belyakov\Library\Exception\InvalidParameter
     */
    public function testSuccessCompareHash()
    {
        $file = new \Belyakov\Library\FileReaders\Local($this->getTestFilePath());
        $module = new \Belyakov\Library\Modules\CompareHash($this->getValidAlgotithm(), $this->getValidHash());
        $this->assertTrue($module->process($file));
    }

    /**
     * Test fail hash compare
     *
     * @covers SearchString::process
     * @throws \Belyakov\Library\Exception\InvalidParameter
     */
    public function testFailCompareHash()
    {
        $file = new \Belyakov\Library\FileReaders\Local($this->getTestFilePath());
        $module = new \Belyakov\Library\Modules\CompareHash($this->getValidAlgotithm(), 'invalid_hash');
        $this->assertFalse($module->process($file));
    }

    /**
     * Get fail search string
     *
     * @return string
     */
    protected function getValidAlgotithm()
    {
        return 'md5';
    }

    /**
     * Get valid hash file
     *
     * @return string
     */
    protected function getValidHash()
    {
        return 'e27c2b9ebe25278400f6bc64129b2ddb';
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
}

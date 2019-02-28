<?php

use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * Test config files
     */
    protected $file = 'config.yaml';
    protected $invalidFile = 'fail-config.yaml';

    /**
     * Test config values
     */
    protected $testConfigMimeTypes = ['plain' => 'text/plain'];
    protected $testConfigFileSize = 1024;

    /**
     * Test that correct file can be parsed
     *
     * @covers Config::__construct
     */
    public function testCanParseFile()
    {
        $config = new \Belyakov\Library\Config($this->getConfigPath($this->file));
        $this->assertInstanceOf(\Belyakov\Library\Config::class, $config);
    }

    /**
     * Test that incorrect file can not be parsed
     *
     * @covers Config::__construct
     */
    public function testCanNotParseInvalidFile()
    {
        $this->expectException(\Symfony\Component\Yaml\Exception\ParseException::class);
        $config = new \Belyakov\Library\Config($this->getConfigPath($this->invalidFile));
    }

    /**
     * Test correct returned mime type from config
     *
     * @covers Config::getMimeTypes
     */
    public function testCorrectMimeConfigValue()
    {
        $config = new \Belyakov\Library\Config($this->getConfigPath($this->file));
        $this->assertEquals($config->getMimeTypes(), $this->testConfigMimeTypes);
    }

    /**
     * Test correct returned file size from config
     *
     * @covers Config::getFileSize
     */
    public function testCorrectFileSizeConfigValue()
    {
        $config = new \Belyakov\Library\Config($this->getConfigPath($this->file));
        $this->assertEquals($config->getFileSize(), $this->testConfigFileSize);
    }

    /**
     * Get full path to config file
     *
     * @param $file
     * @return string
     */
    private function getConfigPath($file)
    {
        return dirname(__FILE__) . '/../' . $file;
    }
}
<?php

namespace Belyakov\Library\FileReaders;

use Belyakov\Library\Contracts\FileInfoContract;
use Belyakov\Library\Contracts\FileReaderContract;

/**
 * Class Remote
 * Require ssh2 library
 *
 * @package Belyakov\Library\FileReaders
 *
 */
class Remote extends AbstractFile implements FileReaderContract, FileInfoContract
{
    private $username;
    private $password;
    private $host;

    /**
     * @var null
     */
    private $port;

    /**
     * File info
     *
     * @var null
     */
    private $info = [];

    /**
     * Connection to remote server
     * @var resource
     */
    private $stream;

    /**
     * Remote constructor.
     *
     * @param string $path Absolute path to file
     * @param $username
     * @param $password
     * @param $host
     * @param null $port
     */
    public function __construct($path, $username, $password, $host, $port = null)
    {
        $this->path = $path;

        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * Open file
     *
     * @return resource
     */
    public function open()
    {
        $this->handle = $this->openStream();

        return $this->handle;
    }

    /**
     * Get file mime-type
     *
     * @return string
     */
    public function getMimeType(): string
    {
        // @todo Dont know how to determine remote file mime-type
        return '';
    }

    /**
     * Get file size
     * @return int
     */
    public function getSize(): int
    {
        $info = $this->getInfo();
        return intval($info['size']);
    }

    /**
     * @return mixed|void
     */
    protected function getInfo()
    {
        if (!$this->info) {
            $this->info = ssh2_sftp_stat($this->connect(), $this->path);
        }
        return $this->info;
    }

    /**
     * Connect to remote server
     *
     * @return resource
     */
    protected function connect()
    {
        if (!$this->stream) {
            $connection = \ssh2_connect($this->host, $this->port);
            \ssh2_auth_password($connection, $this->username, $this->password);
            $this->stream = \ssh2_sftp($connection);
        }

        return $this->stream;
    }

    /**
     * Get stream
     *
     * @return bool|resource
     */
    protected function openStream()
    {
        $stream = $this->connect();
        return fopen("ssh2.sftp://" . $stream . $this->path, 'r');
    }
}

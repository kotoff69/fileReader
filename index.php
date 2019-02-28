<?php

require_once './vendor/autoload.php';

use Belyakov\Library\Factories\{
    SearchLocalFileFactory,
    SearchRemoteFileFactory,
    CompareLocalFileHashFactory,
    CompareRemoteFileHashFactory
};

// Usage
// Local search string
echo "Search single line (local):\n";
$needle = 'Try to find me on third line at 432 position.';
$reader = SearchLocalFileFactory::make('./dummy-text.txt', $needle);
var_dump($reader->result());

echo "\nSearch multiple lines (local):\n";
$needle .= "\n" . 'Even if i am on multiple lines';
$reader = SearchLocalFileFactory::make('./dummy-text.txt', $needle);
var_dump($reader->result());

echo "\nCompare hash (local):\n";
// Local compare file hash
$reader = CompareLocalFileHashFactory::make('./composer.json', 'md5', '4114fbe15d6484f99f9e55da372befed');
var_dump($reader->result());


// Remote search string
// Need installed ssh2 lib

$user = '';
$password = '';
$host = '';
$port = null;

$file = '/path/to/remote/file';
$searchString = 'put here what we want to find';
echo "\nSearch single line (remote):\n";
$reader = SearchRemoteFileFactory::make($file, $searchString, $user, $password, $host, $port);
var_dump($reader->result());

// Remote compare file hash
$algorithm = 'md5'; // available in hash_algos()
$hash = 'put your file hash here to compare';
echo "\nCompare hash (remote):\n";
$reader = CompareRemoteFileHashFactory::make($file, $algorithm, $hash, $user, $password, $host, $port);
var_dump($reader->result());

